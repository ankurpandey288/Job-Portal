<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEMailTemplateRequest;
use App\Models\EmailTemplate;
use App\Queries\EmailTemplateDataTable;
use App\Repositories\EmailTemplateRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use Yajra\DataTables\DataTables;

/**
 * Class EmailTemplateController
 */
class EmailTemplateController extends Controller
{
    /**
     * @var EmailTemplateRepository
     */
    public $emailTemplateRepository;

    /**
     * EmailTemplateController constructor.
     * @param  EmailTemplateRepository  $emailTemplateRepository
     */
    public function __construct(EmailTemplateRepository $emailTemplateRepository)
    {
        $this->emailTemplateRepository = $emailTemplateRepository;
    }

    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View|Application
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new EmailTemplateDataTable())->get())->make(true);
        }

        return view('email_templates.index');
    }

    /**
     * @param  EmailTemplate  $emailTemplate
     *
     * @return Application|Factory|View
     */
    public function edit(EmailTemplate $emailTemplate)
    {
        return view('email_templates.edit', compact('emailTemplate'));
    }

    /**
     * @param  UpdateEMailTemplateRequest  $request
     * @param  EmailTemplate  $emailTemplate
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateEMailTemplateRequest $request, EmailTemplate $emailTemplate)
    {
        $input = $request->all();

        $this->emailTemplateRepository->update($input, $emailTemplate->id);

        Flash::success('Email Template updated successfully.');

        return redirect(route('email.template.index'));
    }
}
