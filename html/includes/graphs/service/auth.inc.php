<?php

if (is_numeric($vars['id']))
{
  $service = dbFetchRow("SELECT * FROM services WHERE service_id = ?", array($vars['id']));

  if (is_numeric($service['device_id']) && ($auth || device_permitted($service['device_id'])))
  {
    $device = device_by_id_cache($service['device_id']);

    // This doesn't quite work for all yet.
    $rrd_filename  = $config['rrd_dir'] . "/" . $device['hostname'] . "/" . safename("service-" . $service['service_type'] . "-" . $service['service_id'] . ".rrd");

    $title  = generate_device_link($device);
    $title .= " :: Service :: " . htmlentities($service['service_type']);
    $auth = TRUE;
  }
}

?>
