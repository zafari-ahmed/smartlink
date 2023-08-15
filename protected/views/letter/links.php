<!--
<script src="<?php //echo Yii::app()->request->baseUrl; ?>/assets/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
  var links = '<?php //echo $d?>';
  var d = JSON.parse(links);
  $(d).each(function(i,e){
  	window.open(e,'_blank');
  })
</script>
-->

<?php
echo '<ol>';
foreach($links as $ind=>$link){
	echo '<li>&nbsp;<a target="_blank" href="'.$link.'">'.$link.'</a></li>';
}
echo '</ol>';
?>