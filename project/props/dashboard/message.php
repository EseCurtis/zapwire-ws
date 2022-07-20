<?php
    $report = new Report();
    $user = new User();

    $current_message = $report->get_report($_data['message_id']);
    $report->read($_data['message_id']);
    
    $current_message['sender_name'] = $user->fetch_by_id($current_message['author_id'])['email'];
    $sender_info = $user->fetch_by_id($current_message['author_id']);
?>


<!-- display messages with date sent and subject and content -->
<!-- <div class="card">
    <div class="card-header d-flex">
        <h5 class="title badge badge-info">Message from:</h5>
        <span class="ml-2"> An Administrator </span>
       
        <h5 class="title badge badge-info">At:</h5>
        
    </div>
    <div class="card-body">
        <div class="d-flex">
            <p class="title  badge badge-info">Subject: </p>
            <p class="text-bold ml-2"> <?= $current_message["subject"]; ?></p>
        </div>
        <div class="d-block mt-4">
            <p class="title  badge badge-success">Content: </p>
            <p class="text-bold ml-2 mt-3"> <?= $current_message["content"]; ?></p>
        </div>
    </div>
</div> -->

<div class="card">
    <div class="message-card">
        <div class="message-from">
            <b>From:</b>
            <span> <?= $current_message["sender_name"]; ?></span>
            (
                <!-- time-ago -->
                <span class="time-ago" data-time="<?= $current_message["date_created"]; ?>">
                    {{time}}
                </span>
            )
        </div>
        <div class="message-title">
            <b>Subject:</b>
            <span> <?= $current_message["subject"]; ?></span>
        </div>
        <div class="message-content">
            <p>
                <?= $current_message["content"]; ?>
            </p>
        </div>
    </div>
</div>

