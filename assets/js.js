const flashData = $('.flash-data').data('flashdata');
//const flashData4 = $('.flash-data').data('flashdata');
//const flashData1 = $('.flash-data1').data('flashdata'); //PUNYA IWAYRIWAY
// const flashError = $('.flash-error').data('flashdata');

if (flashData) {
	Swal({
		position: 'top',
		type: 'success',
		title: flashData,
		showConfirmButton: false,
		timer: 2000
	})
}

// if (flashData4) {
// 	Swal({
// 		position: 'top',
// 		type: 'warning',
// 		title: "Dihapus",
// 		text: flashData4,
// 		showConfirmButton: false,
// 		timer: 2000
// 	})
// }

// if(flashData1){
// 	Swal({
// 		position: 'center',
// 		type: 'error',
// 		title: "Tolak",
// 		text: flashData1,
// 		showConfirmButton: false,
// 		timer: 2000
// 	});
// }

// if(flashError){
// 	Swal({
// 		position: 'top',
// 		type: 'error',
// 		title: flashdata,
// 		showConfirmButton: false,
// 		timer: 2000
// 	})
// }



// tombol-hapus
$('.tombol-hapus').on('click', function (e) {

	e.preventDefault();
	const href = $(this).attr('href');

	Swal({
		title: 'Apakah anda yakin',
		text: "data akan dihapus",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Hapus Data!'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	})

});

// Edit Matrix Perdin
$(document).ready(function () {
	$('#edit-matrixperdin').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget);
		var modal = $(this)

		modal.find('#no').attr("value", div.data('id'));
		modal.find('#ka').attr("value", div.data('ka'));
		modal.find('#kt').attr("value", div.data('kt'));
		modal.find('#j').attr("value", div.data('j'));
		modal.find('#mh').attr("value", div.data('mh'));
	});
});

$(document).ready(function () {
	$('#edit-stkbskenario').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget);
		var modal = $(this)
		modal.find('#no').attr("value", div.data('id'));
		modal.find('#nm').attr("value", div.data('nm'));
    modal.find('#kt').attr("value", div.data('kt'));
	});
});

$(document).ready(function () {
	$('#edit-skenproject').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget);
		var modal = $(this)
		modal.find('#pro').attr("value", div.data('pro'));
		modal.find('#sken').attr("value", div.data('sken'));
    modal.find('#juml').attr("value", div.data('juml'));
		modal.find('#kunj').attr("value", div.data('kunj'));
		modal.find('#nosken').attr("value", div.data('nosken'));
	});
});

$(document).ready(function () {
	$('#bayarstkb').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget);
		var modal = $(this)
		modal.find('#nomorstkb').attr("value", div.data('nomorstkb'));
		modal.find('#pembayar').attr("value", div.data('pembayar'));
		modal.find('#term').attr("value", div.data('term'));
		modal.find('#totalnya').attr("value", div.data('totalnya'));
		modal.find('#ops').attr("value", div.data('ops'));
		modal.find('#trk').attr("value", div.data('trk'));
		modal.find('#akomodasi').attr("value", div.data('akomodasi'));
		modal.find('#bpjs').attr("value", div.data('bpjs'));
		modal.find('#perdin').attr("value", div.data('perdin'));
	});
});

$(document).ready(function () {
	$('#editkotakab').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget);
		var modal = $(this)
		modal.find('#nonya').attr("value", div.data('nonya'));
		modal.find('#provinsi').attr("value", div.data('provinsi'));
		modal.find('#kabkot').attr("value", div.data('kabkot'));
		modal.find('#jns').attr("value", div.data('jns'));
		modal.find('#ins').attr("value", div.data('ins'));
		modal.find('#pulau').attr("value", div.data('pulau'));
	});
});

//  **************************** JAVASCRIPT AGIL ********************** //
$(document).ready(function () {
	$('#modalassignshp').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget);
		var modal = $(this)
		modal.find('#kota').attr("value", div.data('kota'));
		modal.find('#npro').attr("value", div.data('npro'));
		modal.find('#stkb').attr("value", div.data('stkb'));
		modal.find('#kpro').attr("value", div.data('kpro'));
		modal.find('#cab').attr("value", div.data('cab'));
		modal.find('#kcab').attr("value", div.data('kcab'));
		modal.find('#kategori').attr("value", div.data('kategori'));
		modal.find('#krg').attr("value", div.data('krg'));
		modal.find('#supv').attr("value", div.data('supv'));
	});
});

$(document).ready(function () {
	$('#modal_keterangan').on('show.bs.modal', function (event) {
        $('#iniketerangan').empty();
		var div = $(event.relatedTarget);
        var modal = $(this)
 		// modal.find('#keterangan').attr("value", div.data('keterangan'));
        var ket = div.data('keterangan');
            var bodymodal = `<textarea rows="5" cols="87" readonly>`+ket+`</textarea>`
        $('#iniketerangan').append(bodymodal);
	});
});



//  **************************** //JAVASCRIPT AGIL ********************** //
