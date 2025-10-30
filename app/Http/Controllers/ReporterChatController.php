<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CaseReport;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ReporterChatController extends Controller
{
    public function index($caseId)
    {
        $case = CaseReport::where('id', $caseId)
            ->where('reporter_id', Auth::id())
            ->firstOrFail();
        $messages = Message::where('case_id', $case->id)->with('user')->latest()->get();
        return view('reporter.chat', compact('case', 'messages'));
    }

    public function sendMessage(Request $request, $caseId)
    {
        $case = CaseReport::where('id', $caseId)
            ->where('reporter_id', Auth::id())
            ->firstOrFail();
        $request->validate(['message' => 'required|string']);
        Message::create([
            'case_id' => $case->id,
            'user_id' => Auth::id(),
            'content' => $request->message,
        ]);
        return redirect()->route('reporter.chat', $case->id);
    }
}
