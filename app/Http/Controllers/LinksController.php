<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LinksController extends Controller
{
    /**
     * Show the unique link.
     *
     * @return Renderable|RedirectResponse
     */
    public function home(): Renderable|RedirectResponse
    {
        if (!auth()->check()) {
            return redirect(route('register'));
        }

        return view('links.home', [
            'link' => $this->getLink(),
        ]);
    }

    /**
     * Link page.
     *
     * @return Renderable
     */
    public function link(): Renderable
    {
        $link = $this->getLink(
            request()->route('key'),
        );

        if (!$link) {
            abort(404);
        }

        return view('links.link', [
            'link' => $link,
            'results' => $link->results()->orderBy('id', 'desc')->limit(3)->get(),
        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function regenerate(): RedirectResponse
    {
        $link = $this->getLink(
            request()->route('key'),
        );

        if (!$link) {
            abort(404);
        }

        DB::transaction(function () use (&$link) {
            $link->update([
                'active' => false,
            ]);

            $link = $link->user->links()->create([
                'key' => Link::generateKey(),
                'expired_at' => now()->addDays(7),
            ]);
        });

        Session::flash('message', 'Link successfully regenerated.');

        return redirect(route('links.link', $link->key));
    }

    /**
     * @return RedirectResponse
     */
    public function deactivate(): RedirectResponse
    {
        $link = $this->getLink(
            request()->route('key'),
        );

        if (!$link) {
            abort(404);
        }

        $link->update([
            'active' => false,
        ]);

        Session::flash('message', 'Link successfully deactivated.');

        return redirect('home');
    }

    /**
     * @return RedirectResponse
     */
    public function play(): RedirectResponse
    {
        $link = $this->getLink(
            request()->route('key'),
        );

        if (!$link) {
            abort(404);
        }

        $percent = 0;
        $score = rand(1, 1000);
        $win = $score % 2 == 0;

        if ($win) {
            if ($score > 900) {
                $percent = 70;
            } elseif ($score > 600) {
                $percent = 50;
            } elseif ($score > 300) {
                $percent = 30;
            } else {
                $percent = 10;
            }
        }

        $result = $link->results()->create([
            'score' => $score,
            'win' => $win,
            'sum' => (int) round($score * $percent),
        ]);

        if ($win) {
            $amount = number_format($result->sum / 100, 2);
            Session::flash('message', 'Congratulations, you won $' . $amount . '! (Score: '. $result->score .').');
        } else {
            Session::flash('message', 'Unfortunately you didn\'t win (Score: '. $result->score .').');
        }

        return redirect(route('links.link', $link->key));
    }

    /**
     * @param string|null $key
     * @return Link|null
     */
    protected function getLink(string $key = null): Link|null
    {
        $query = $key
            ? Link::where('key', $key)
            : auth()->user()->links();

        $link = $query
            ->where(['active' => true])
            ->orderBy('id', 'desc')
            ->first();

        if ($link && $link->expired_at < now()) {
            $link->active && $link->update(['active' => false]);
            $link = null;
        }

        return $link;
    }
}
