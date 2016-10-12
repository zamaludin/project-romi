<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<link href='<?=base_url('assets/fullcalendar-2.6.1/fullcalendar.min.css');?>' rel='stylesheet' />
<link href='<?=base_url('assets/fullcalendar-2.6.1/fullcalendar.print.css');?>' rel='stylesheet' media='print' />
<script type="text/javascript" src="<?=base_url('assets/js/moment.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/fullcalendar-2.6.1/fullcalendar.min.js');?>"></script>
<script src='<?=base_url('assets/fullcalendar-2.6.1/lang/id.js');?>'></script>
<style type="text/css">
	#main-content {
		width: 100%;
		background-color: #fff;
	}
	
	.fc-day-grid-event .fc-content {
		white-space: normal;
	}

	#calendar {
		max-width: 647px;
		margin: 0 auto;
	}
</style>
<section id="main-content" class="calendar">
	<div class="widget-title">
		<h4><?=strtoupper($menu['agenda'] == '' ? 'Agenda Sekolah' : $menu['agenda']);?> <i class="fa fa-calendar"></i> </h4>
	</div>
	<div class="widget">
		<div id="calendar"></div>		
	</div>
</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>
<script>
	$(document).ready(function() {
		$('#calendar').fullCalendar({
			defaultDate: '<?=date("Y-m-d");?>',
			eventLimit: true,
			events: {
				url: '<?=site_url("home/get_agenda_sekolah");?>'
			}
		});
	});
</script>