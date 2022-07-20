<?php
    $stat = new Stat();

    $year = $_data['current_year'];

    $users_by_year = $stat->get_per_months($year);
    $channels_by_year = $stat->get_per_months($year, 'channels');
    $logs_by_year = $stat->get_per_months($year, 'logs');

    $users_by_year_array = $stat->to_array($users_by_year);
    $channels_by_year_array = $stat->to_array($channels_by_year);
    $logs_by_year_array = $stat->to_array($logs_by_year);
?>

<script>
    let signups_chart_data = <?=json_encode($users_by_year_array); ?>;
    let channels_chart_data = <?=json_encode($channels_by_year_array); ?>;
    let logs_chart_data =  <?=json_encode($logs_by_year_array); ?>;
</script>