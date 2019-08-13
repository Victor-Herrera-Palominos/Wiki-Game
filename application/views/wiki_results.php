<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->helper('form');
?><!DOCTYPE html>
<!-- Author: Victor H-->
<html lang="en">
<head>
	<link href="<?php echo base_url('/public/css/mainstyle.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('/public/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<meta charset="utf-8">
	<title>Wikipedia Game Results</title>
</head>
<body>
    <!--Table gets data from PHP function-->
    <div id="results">
        <table>
            <tr>
                <th>User</th>
                <th>Path</th>
            </tr>
            <?php foreach ($results as $results_item): ?>
                <tr>
                    <td><?php echo $results_item['User']; ?></td>
                    <td><?php echo $results_item['Path']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <br>
    <!--Link back to the main page, always stays at the bottom of your window, to avoid having to scroll to see it-->
    <div class="jumppage" style="bottom:0;position: fixed;">
        <a href="<?php echo site_url('main/index'); ?>">Return to Main Page</a>
    </div>
</body>
</html>