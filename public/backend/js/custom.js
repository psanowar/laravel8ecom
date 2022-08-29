

jQuery(document).ready(function(){

    jQuery(document).on('click', '.catEdit',function(e){
        e.preventDefault();

        var catId=jQuery(this).val();
        $.ajax({
            url:'catedit/'+catId,
            type:'GET',
            dataType:'json',
            success:function(result){
                jQuery("#name").val(result.data.name);
                jQuery("#des").val(result.data.des);
                jQuery("#tag").val(result.data.tag);
                
                jQuery(".sts").val(result.data.status);
                if(result.data.status==1){
                    jQuery(".sts").text("Active");
                }
                else{
                    jQuery(".sts").text("Inactive");
                }
                
            }
        });
    });


    showData();
    function showData(){
        $.ajax({
            url:'catshow',
            type:'GET',
            datatype:'json',
            success:function(result){
                var sl=1;
                jQuery(".tbody").html('');
                $.each(result.data, function(key, item){
                    jQuery(".tbody").append('<tr>\
                    <td>'+sl+'</td>\
                    <td>'+item.name+'</td>\
                    <td>'+item.des+'</td>\
                    <td>'+item.tag+'</td>\
                    <td>'+item.status+'</td>\
                    <td>\
                      <button data-target="#editCategory" data-toggle="modal" class="btn btn-sm btn-info catEdit" value="'+item.id+'" ><i class="fa fa-edit"></i></button>\
                      <button  value="'+item.id+'" >Delete</button>\
                    </td>\
                  </tr>');
                  sl++;
                });
            }
        });
    }

    jQuery(".addCategory").click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var name=jQuery(".name").val();
        var des=jQuery(".des").val();
        var tag=jQuery(".tag").val();
        var status=jQuery(".status").val();

        $.ajax({
            url:'catinsert',
            type:'POST',
            dataType:'json',
            data:{
                'name':name,
                'des':des,
                'tag':tag,
                'status':status
            },
            success: function(result){
                if(result.success == 'faild'){
                    jQuery(".nameError").text(result.errors.name);
                    jQuery(".desError").text(result.errors.des);
                    jQuery(".tagError").text(result.errors.tag);

                }
                else{
                    showData();
                    jQuery(".msg").append('<div class="alert alert-success">'+result.msg+'</div>');
                    jQuery("#addCategory").modal('hide');
                    jQuery("#addCategory").find('input').val('');
                    jQuery("#addCategory").find('textarea').val('');
                    jQuery(".msg").fadeOut(5000);
                    
                }
            }
        });
    });


});