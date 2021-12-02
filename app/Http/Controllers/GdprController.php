<?php

namespace App\Http\Controllers;

use App\User;
use Dialect\Gdpr\Http\Requests\GdprDownload;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class GdprController extends Controller
{
    /**
     * Download the GDPR compliant data portability JSON file.
     *
     * @param  \Dialect\Package\Gdpr\Http\Requests\GdprDownload  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function download(GdprDownload $request)
    {
        try {
            $credentials = [
                $request->user()->getAuthIdentifierName() => $request->user()->getAuthIdentifier(),
                'password'                                => $request->input('password'),
            ];

            if (!Auth::attempt($credentials)) {
                return back()->with('confirm_password_error', 'Invalid password');
            }

            return response()->json(
                $request->user()->portable(),
                200,
                [
                    'Content-Disposition' => 'attachment; filename="user.json"',
                ]
            );
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
        }
    }

    /**
     * Shows The GDPR terms to the user.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showTerms()
    {
        return view('gdpr.message');
    }

    /**
     * Saves the users acceptance of terms and the time of acceptance.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function termsAccepted()
    {
        $user = Auth::user();

        $user->update([
            'accepted_gdpr' => true,
        ]);

        return redirect()->to('/');
    }

    /**
     * Saves the users denial of terms and the time of denial.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function termsDenied()
    {
        $user = Auth::user();

        $user->update([
            'accepted_gdpr' => false,
        ]);

        return redirect()->to('/');
    }

    /**
     * Anonymizes the user and sets the boolean.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function anonymize($id)
    {
        $user = User::findOrFail($id);

        $user->anonymize();

        $user->update([
            'isAnonymized' => true,
        ]);

        return redirect()->back();
    }
}
