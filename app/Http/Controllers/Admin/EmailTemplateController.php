<?php
namespace App\Http\Controllers\Admin;

use Exception;
use Throwable;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\DataTables\EmailTemplateDataTable;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\EmailTemplate\StoreRequest;
use App\Http\Requests\EmailTemplate\UpdateRequest;
use Illuminate\Auth\Access\AuthorizationException;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the email templates.
     */
    public function index(EmailTemplateDataTable $dataTable)
    {
        try
        {
            Gate::authorize('email-templates.view');
            return $dataTable->render('admin.email-templates.index');
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning', 'You are not authorized to access this resource.');
        }
        catch (Throwable $e)
        {
            return to_route('admin.dashboard')->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new email template.
     */
    public function create()
    {
        try
        {
            Gate::authorize('email-templates.add');
            return view('admin.email-templates.create');
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning', 'You are not authorized to access this resource.');
        }
        catch (Throwable $e)
        {
            return to_route('admin.email-templates.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created email template in storage.
     */
    public function store(StoreRequest $request)
    {
        try
        {
            Gate::authorize('email-templates.add');
            $validated = $request->validated();
            EmailTemplate::create($validated);
            return to_route('admin.email-templates.index')->with('success', 'Email template created successfully.');
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning', 'You are not authorized to access this resource.');
        }
        catch (ValidationException $e)
        {
            return back()->withErrors($e->validator->errors())->withInput();
        }
        catch (Throwable $e)
        {
            return to_route('admin.email-templates.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified email template.
     */
    public function edit($id)
    {
        try
        {
            Gate::authorize('email-templates.edit');
            $emailTemplate = EmailTemplate::findOrFail($id);
            return view('admin.email-templates.edit', compact('emailTemplate'));
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning', 'You are not authorized to access this resource.');
        }
        catch (Throwable $e)
        {
            return to_route('admin.email-templates.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified email template in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        try
        {
            Gate::authorize('email-templates.edit');
            $emailTemplate = EmailTemplate::findOrFail($id);
            $validated = $request->validated();
            $emailTemplate->update($validated);
            return to_route('admin.email-templates.index')->with('success', 'Email template updated successfully.');
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning', 'You are not authorized to access this resource.');
        }
        catch (ValidationException $e)
        {
            return back()->withErrors($e->validator->errors())->withInput();
        }
        catch (Throwable $e)
        {
            return to_route('admin.email-templates.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified email template from storage.
     */
    public function destroy($id)
    {
        try
        {
            Gate::authorize('email-templates.delete');
            $emailTemplate = EmailTemplate::findOrFail($id);
            $emailTemplate->delete();
            return to_route('admin.email-templates.index')->with('success', 'Email template deleted successfully.');
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning', 'You are not authorized to access this resource.');
        }
        catch (Exception $e)
        {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified email template.
     */
    public function show($id)
    {
        try
        {
            Gate::authorize('email-templates.view');
            $emailTemplate = EmailTemplate::findOrFail($id);
            return view('admin.email-templates.show', compact('emailTemplate'));
        }
        catch (AuthorizationException $e)
        {
            return to_route('admin.dashboard')->with('warning', 'You are not authorized to access this resource.');
        }
        catch (Throwable $e)
        {
            return to_route('admin.email-templates.index')->with('error', $e->getMessage());
        }
    }
}
