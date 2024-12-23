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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the unique link.
     *
     * @return Renderable
     */
    public function home(): Renderable
    {
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
        $link = $this->getLink();

        return view('links.link', [
            'link' => $link,
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
