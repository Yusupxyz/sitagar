<script>
    
    function confirmdelete(linkdelete) {
        alertify.confirm("Apakah anda yakin akan  menghapus data tersebut?", function() {
            location.href = linkdelete;
        }, function() {
            alertify.error("Penghapusan data dibatalkan.");
        });
        $(".ajs-header").html("Konfirmasi");
        return false;
    }
    $(':checkbox[name=selectall]').click(function () {
        $(':checkbox[name=id]').prop('checked', this.checked);
    });

    $("#formbulk").on("submit", function () {
        var rowsel = [];
        $.each($("input[name='id']:checked"), function () {
            rowsel.push($(this).val());
        });
        if (rowsel.join(",") == "") {
            alertify.alert('', 'Tidak ada data terpilih!', function () {});

        } else {
            var prompt = alertify.confirm('Apakah anda yakin akan menghapus data tersebut?',
                'Apakah anda yakin akan menghapus data tersebut?').set('labels', {
                ok: 'Yakin',
                cancel: 'Batal!'
            }).set('onok', function (closeEvent) {

                $.ajax({
                    url: "data_pegawai/deletebulk",
                    type: "post",
                    data: "msg = " + rowsel.join(","),
                    success: function (response) {
                        if (response == true) {
                            location.reload();
                        }
                        //console.log(response);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });

            });
            $(".ajs-header").html("Konfirmasi");
        }
        return false;
    });

    function myFunction() {
        var x = document.getElementById("nik").value;
        if(nik.length != 16){
            alert("NIK harus teridiri dari 16 karakter!");
            document.getElementById("nik").focus();
        }
    }
     
    $('#tahun_lulus').datepicker({
         minViewMode: 2,
         format: 'yyyy'
       });

       function myFunction2() {
        var x = document.getElementById("tanggal_sk_awal").value;
        let result = x.substring(0,4);
        var y = document.getElementById("tahun_lulus").value;
        if(result < y){
            alert("Tahun SK Awal tidak boleh dibawah tahun lulus!");
            document.getElementById("tanggal_sk_awal").value="";
        }
    }


    $(document).ready(function(){
		$('#table1').DataTable();
	});
</script>