$(function(){

    $('#cluster').on('click',function () {
        let faskes = $(this).data('faskes')
        let pass = $(this).data('pass')
        let survey_id = $(this).data('survey')

        if (pass < faskes) {

            Notiflix.Confirm.show(
            'Yakin?',
            'Jumlah puskesmas yang mengisi survey kurang dari total puskesmas!',
            'Yakin',
            'Tidak',
            () => clustering({survey_id}),
            () => {},
            );

            return false;
        }


         Notiflix.Confirm.show(
            'Yakin?',
            "Tekan \"Yakin\" untuk mengelompokan",
            'Yakin',
            'Tidak',
            () => clustering({survey_id}),
            () => {},
            );

     })




})


const clustering = (data)=>{
    $.ajax({
        url:'/cluster',
        data,
        type:'POST',
        dataType:'JSON',
          headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf_token]").prop("content"),
        },
    }).done((res)=>{

        window.location.href=`/hasil-clustering/${data.survey_id}`
    })
}
