$(document).ready(function() {
	 /* Guestbook */
	$("#btn-guestbook").click(function(){
		var action_hubungi_kami = $("#form-hubungi-kami").attr('action');
		var post_data = {
			nama: $("#nama").val(),
			email: $("#email").val(),
			url: $("#url").val(),
			pertanyaan: $("#pertanyaan").val(),
			captcha: $("#captcha").val()
		};
	  	$.ajax({
			type: "POST",
			url: action_hubungi_kami,
			data: post_data,
			beforeSend: function() {
				$('#form-hubungi-kami').slideUp('fast');
			 	$('#hubungi_kami_loading').show();
			}, success: function(response) {
				$('#hubungi_kami_loading').hide();
				$("#hubungi_kami_message").fadeIn('slow');
				if(response == 0) {
					$("#hubungi_kami_message").addClass('alert-danger');
					$("#hubungi_kami_message").text('Data tidak tersimpan !');
					setTimeout(function() {
						$("#hubungi_kami_message").hide('fast');
						$("#hubungi_kami_message").removeClass('alert-danger');
						$("#hubungi_kami_message").text('');
						$('#form-hubungi-kami').slideDown('fast');
					}, 2000);
				} else if(response == 1) {
					$("#hubungi_kami_message").addClass('alert-success');
					$("#hubungi_kami_message").text('Pesan anda sudah tersimpan pada sistem kami. Pesan balasan akan kami sampaikan melalui alamat email anda. Terima kasih!');
					setTimeout(function() {
						$("#hubungi_kami_message").hide('fast');
						$("#hubungi_kami_message").removeClass('alert-success');
						$("#hubungi_kami_message").text('');
						$('#form-hubungi-kami').slideDown('fast');
						$("#nama").val('');
						$("#email").val('');
						$("#url").val('');
						$("#pertanyaan").val('');
						$("#captcha").val('');
					}, 7000);
				}
			}
		});
	  return false;
	 });

	/* Polling */
	$("#submit-polling").click(function(){
		if ($('input[name=jawaban_id]:checked').val() != null) {
			var action = $("#form-polling").attr('action');
			var postPolling = {
				jawaban_id: $('input[name=jawaban_id]:checked').val()
			};
			$.ajax({
				type: "POST",
				url: action,
				data: postPolling,
				beforeSend: function() {
					$('#form-polling').slideUp('fast');
					$('#loading-polling').show();
				}, success: function(response) {
					console.log(response);
					$('#loading-polling').hide();
					$("#message-polling").fadeIn('slow');
					if(response == 0) {
						$("#message-polling").text('Jawaban tidak tersimpan !');
					} else if(response == 1) {
						$("#message-polling").text('Terima kasih sudah menjawab pertanyaan kami !');
					} else if(response == 2) {
						$("#message-polling").text('Anda sudah menjawab polling kami !');
					}
					setTimeout(function() {
						$("#message-polling").hide('fast');
						$("#message-polling").text('');
						$('#form-polling').slideDown('fast');
						$("input:radio").removeAttr("checked");
					}, 2000);
				}
			});
			return false;
		} else {
			$('#loading-polling').hide();
			$("#message-polling").fadeIn('slow');
			$("#message-polling").text('Anda belum memilih jawaban !');
			setTimeout(function() {
				$("#message-polling").hide('fast');
				$("#message-polling").text('');
				$('#loading-polling').hide();
				$('#form-polling').slideDown('fast');
			}, 2000);
			return false;
		}
	});
});