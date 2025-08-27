<?php

namespace App\Http\Controllers\Admin;


use App\Models\Message;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class MessageController extends Controller
{
    public function index()
    {
        $messages = QueryBuilder::for(Message::class)
            ->allowedFilters([
                'name',
                'subject',
                'email',
            ])
            ->latest()
            ->paginate(config('app.paginate_count'));

        return view('admin.pages.messages.index')->with([
            'messages' => $messages,
        ]);
    }

    public function show(Message $message)
    {
        return view('admin.pages.messages.show')->with([
            'message' => $message,
        ]);
    }

    public function replay(Message $message)
    {
        return view('admin.pages.messages.replay_message')->with([
            'message' => $message,
        ]);
    } // End of replay

    public function replayMessage(Message $message)
    {

        // request()->validate([
        //     'text_replay' => 'required'
        // ]);

        // Mail::to($message->email)->send(new ReplayMessageMail($message, request('text_replay')));

        // $message->is_replay = 1;
        // $message->text_replay = request('text_replay');
        // $message->save();

        return redirect()->back()->with('success', 'تم إرسـال الرد بنجاح');
    } // End of replayMessage

    public function destroy(Message $message)
    {
        try {
            $message->delete();
        } catch (\Exception $e) {
            return $e->getMessage(); //back()->with('warning', \WARNING_MESSAGE_ERROR);
        }
        flash()->success(__('ui.alerts.messages.delete', ['entity' => __('ui.entities.message'), 'name' => $message->title]));

        return redirect()->route('admin.messages.index')->with('success', 'تم حذف الرسالة بنجاح');
    }
}
