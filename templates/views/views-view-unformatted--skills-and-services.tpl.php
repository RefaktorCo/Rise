<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>

<?php $count = '0'; foreach ($rows as $id => $row): ?>
  <?php if ($count % 3 == 0) { echo "<div class='row'>"; } ?>
  <?php  print $row; $count++; ?>
  <?php if ($count % 3 == 0  || ($count % 2 != 0 && $count == count($rows))) { echo "</div>"; } ?>
<?php endforeach; ?>