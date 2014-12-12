<?php
defined('_JEXEC') or die;

$mime = !empty($this->result->mime) ? 'mime-' . $this->result->mime : null;

$base = JUri::getInstance()->toString(array(
	'scheme',
	'host',
	'port'
));

$length = $this->params->get('description_length', 255) - strlen($this->query->input);


if (!empty($this->query->highlight) && empty($this->result->mime) && $this->params->get('highlight_terms', 1) && JPluginHelper::isEnabled('system', 'highlight')) {
	$route = $this->result->route . '&highlight=' . base64_encode(json_encode($this->query->highlight));
} else {
	$route = $this->result->route;
}
?>
	<li>
		<div class="container">
			<div class="row">
				<h4 class="result-title <?php echo $mime; ?>">
					<a href="<?php echo JRoute::_($route); ?>">
						<?php echo $this->result->title; ?>
					</a>
					<?php
					$time_limit = explode(':',$this->result->duration);
					if($time_limit[0] < 7) {
						?>
						<button name="Request" id="<?php echo $this->result->id; ?>"
								class="request-btn pull-right btn btn-primary"><span
								class="icon-signal icon-white"></span> Request
						</button>
					<?php
					}
					?>
				</h4>
			</div>
		</div>

		<?php if ($this->params->get('show_description', 1)): ?>
		<figure class="result-text<?php echo $this->pageclass_sfx; ?>">

			<div class="container imgcontainer">
				<div class="row">

					<div class="span2">
						<?php
						if($this->result->art)
						{
							$out = json_decode($this->result->art,true);
							$imgs = $out['img'];
							$imgs = json_decode($imgs,true);
							$images = $imgs['images'][0];
							$thumbs = $images['thumbnails'];
							?>
							<img class="search_img pull-left img-responsive" src="<?php echo $thumbs['small']; ?>" id=""/>
							<?php
						}
						else
						{
							?>
							<img class="search_img pull-left img-responsive" alt="No Artwork Available" id="no-artwork" src="/media/jamla/images/noartworkavailable.jpg"/>
							<?php
						}
						?>
					</div>

					<div class="span3">
						Artist: <?php echo $this->result->artist; ?>
						<br/>
						Song: <?php echo $this->result->song; ?>
						<br/>
						Album: <?php echo $this->result->album; ?>
					</div>

					<div class="span3">
						Genre: <?php echo $this->result->genre; ?>
						<br/>
						Duration: <?php echo $this->result->duration; //date("i:s",$this->result->duration/1000); ?>
						<br/>
						Website: <?php echo $this->result->website; ?>
					</div>

					<div class="span3">
						# of Plays: <?php echo $this->result->count_played; ?>
						<br/>
						# of Reqeusts: <?php echo $this->result->count_requested; ?>
						<br/>
						Last Requested: <?php echo date('m-d-Y',time($this->result->last_requested)); ?>
					</div>

				</div>

				<div class="row">
					<?php if ($this->params->get('show_url', 1)): ?>
						<div class="text-center small result-url<?php echo $this->pageclass_sfx; ?>"><a href="<?php echo JRoute::_($this->result->route); ?>"><?php echo $base . JRoute::_($this->result->route); ?></a></div>
					<?php endif; ?>
				</div>

			</div>



		</figure>
		<?php endif; ?>
	</li>
<?php
//echo strpos($this->result->art,',');
//echo "<pre>";
//$out = json_decode($this->result->art,true);
//$out = $out['img'];
//print_r(json_decode($out,true));
//echo "</pre>";
?>
