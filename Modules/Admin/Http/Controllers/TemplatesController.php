<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Modules\Admin\Entities\MailEclipse;

class TemplatesController extends Controller
{
    public function __construct()
    {
        abort_unless(
            App::environment(config('maileclipse.allowed_environments', ['local'])),
            403
        );
    }

    public function index()
    {
        $skeletons = MailEclipse::getTemplateSkeletons();

        $templates = MailEclipse::getTemplates();

        return View('admin::admin.mailables.sections.templates', compact('skeletons', 'templates'));
    }

    public function new($type, $name, $skeleton)
    {
        $type = $type === 'html' ? $type : 'markdown';

        $skeleton = MailEclipse::getTemplateSkeleton($type, $name, $skeleton);

        return View('admin::admin.mailables.sections.create-template', compact('skeleton'));
    }

    public function view($templateslug = null)
    {
        $template = MailEclipse::getTemplate($templateslug);

        if (is_null($template)) {
            return redirect()->route('templateList');
        }

        return View('admin::admin.mailables.sections.edit-template', compact('template'));
    }

    public function create(Request $request)
    {
        return MailEclipse::createTemplate($request);
    }

    public function select(Request $request)
    {
        $skeletons = MailEclipse::getTemplateSkeletons();

        return View('admin::admin.mailables.sections.new-template', compact('skeletons'));
    }

    public function previewTemplateMarkdownView(Request $request)
    {
        return MailEclipse::previewMarkdownViewContent(false, $request->markdown, $request->name, true);
    }

    public function delete(Request $request)
    {
        if (MailEclipse::deleteTemplate($request->templateslug)) {
            return response()->json([
                'status' => 'ok',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
            ]);
        }
    }

    public function update(Request $request)
    {
        return MailEclipse::updateTemplate($request);
    }
}
