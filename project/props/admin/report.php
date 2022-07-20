<?php
$report = new Report();
$user = new User();

$current_report = $report->get_report($_data['report_id']);
$report->read($_data['report_id']);
// print_r($current_report);
// die();
$current_report['sender_name'] = $user->fetch_by_id($current_report['author_id'])['email'];
$sender_info = $user->fetch_by_id($current_report['author_id']);
?>
<!-- a single report which has subject and content and displays sender name and date sent -->
<button class="btn btn-info" href="
<?=$app->url("admin-board/message?u_id={$sender_info['id']}")?>" async="true">
    Reply
</button>
<div class="card">
    <div class="card-header d-flex">
        <h5 class="title badge badge-info">Report from:</h5>
        <span class="ml-2"> <?= $current_report["sender_name"] ?> </span>
    </div>
    <div class="card-body">
        <div class="d-flex">
            <p class="title  badge badge-info">Subject: </p>
            <p class="text-bold ml-2"> <?= $current_report["subject"]; ?></p>
        </div>
        <div class="d-block mt-4">
            <p class="title  badge badge-success">Content: </p>
            <p class="text-bold ml-2 mt-3"> <?= $current_report["content"]; ?></p>
        </div>
    </div>