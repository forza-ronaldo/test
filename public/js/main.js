$(document).ready(function () {
        var countItemInBasket=0;
        $('.btn-add-basket').on('click',function () {
            if(!($(this).hasClass('Clicked'))){
                $(this).addClass('Clicked');
                countItemInBasket++;
                $(this).addClass('btn-secondary text-white').removeClass('btn-outline-secondary');
                $('.span-Basket').text(countItemInBasket);
            }
            else {
                $(this).removeClass('Clicked');
                $(this).addClass('btn-outline-secondary').removeClass('btn-secondary text-white');
                $('.span-Basket').text(countItemInBasket);
            }
            $('.span-Basket').each(function () {
                if($(this).text()=='0'){
                    $(this).css('display','none');
                }
                else{
                    $(this).css('display','block');
                }
            });
        });

        $('.btn-add-basket').on('click',function () {
           if(!($(this).hasClass('clicked')))
           {
               var id=$(this).data('course_number');
               var url=$(this).data('url');
               var value=$(this).data('value');
               var number=$(this).data('number');
               var course_number=$(this).data('course_number');
               console.log(value);
               var tr=`<tr>
           <td><input type="hidden" value="${id}">
           <input class="form-control " type="text" name="number[]" value="${number}" readonly></td>
           <td><input class="form-control" type="text" name="course_number[]" value="${course_number}" readonly></td>
           <td><input class="form-control" type="text"  value="${value}" readonly></td>
           <td><button class="btn btn-outline-danger btn-del-tr-bill" data-id_btn_clicked="${id}"><i class="fa fa-trash-o" style="font-size: 20px"></i></button></td>
           <tr>`;

           $('.form-pay-all').attr('action',url);

           $('#table-bill tbody').append(tr);
           $(this).addClass('clicked');
           }
           else {
               var oneBtn=$(this);
               $('.btn-del-tr-bill').each(function () {
                   if($(this).data('id_btn_clicked')==oneBtn.data('course_number'))
                   {
                       $(this).click();
                       console.log('done')
                   }
               });
           }
            check_table_is_checked();
        });

        $('body').on('click','.btn-del-tr-bill',function () {
            $(this).closest('tr').detach();
            $('#'+$(this).data('id_btn_clicked')).removeClass('Clicked clicked');
            $('#'+$(this).data('id_btn_clicked')).addClass('btn-outline-secondary').removeClass('btn-secondary text-white');
             countItemInBasket--;
             $('.span-Basket').text(countItemInBasket);
             $('.span-Basket').each(function () {
                 if($(this).text()=='0'){
                     $(this).css('display','none');
                 }
                 else{
                     $(this).css('display','block');
                 }
             });
            check_table_is_checked();
        });

        function check_table_is_checked() {
            if( $('#table-bill tbody').text()==='')
            {
                $('.btn-pay-all').addClass('d-none').removeClass('d-block');
            }
            else
            {
                $('.btn-pay-all').addClass('d-block').removeClass('d-none');
            }
        }
});
