<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SubscriptionPurchase;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Chat;
use App\Models\Quotation;
use App\Models\Notification;
use App\Models\OrderPayment;
use App\Models\Project;
use App\Models\User;
use App\Models\Review;

class ProjectController extends Controller
{
    public function index()
    {
        return view('my-projects');
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'project_category' => 'required|string|max:255',
        ]);

        $project = new Project();
        $project->designer_id = Auth::id();
        $project->name = $request->project_name;
        $project->category = $request->project_category;
        $project->status = 'in_progress';
        $project->save();

        return redirect()->back()->with('success', 'Project created successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->status = $request->status;
        $project->save();

        return back()->with('success', 'Project status updated successfully!');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return back()->with('success', 'Project deleted successfully!');
    }
    
    public function destroyQuotation($id)
    {
        $quotation = Quotation::findOrFail($id);
        $quotation->delete();

        return back()->with('success', 'Quotation deleted successfully!');
    }
}
