<?php
  $size = 50;
  if ($settings['size'] == 'medium') $size = 75;
if ($settings['size'] == 'large') $size = 150;
?>
<div class="avatar {{$settings['radius']}}" style="width: {{$size}}px;height:{{$size}}px;background-image:url({{url($settings['image'])}})"></div>
