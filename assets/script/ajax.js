      ajax_display_add_item();
       function ajax_display_add_item(){
                  $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_display_new',
                    type: 'post',
                    dataType : "JSON",
                    error: function() {
                            alert('Something is wrongs');
                         },
                    success: function (data) {
                      var html = '';
                          var i;
                          for(i=0; i<data.length; i++){
                              html += 
                             "hello"
                            //   '<ul class="products-list product-list-in-box">'+
                            //   '<li class="item">'+
                            //     '<div class="product-img">'+
                            //       '<img src="<?php echo  base_url(); ?>assets/'+data[i].pic+'" alt="Product Image">'+
                            //     '</div>'+
                            //     '<div class="product-info">'+
                            //       '<a href="javascript:void(0)" class="product-title">'+data[i].name+
                            //         '<span class="label label-warning pull-right">'+'₱'+data[i].price+'</span></a>'+
                            //       '<span class="product-description">'+
                            //             data[i].brand+' / '+data[i].code+
                            //       '</span>'+
                            //     '</div>'+
                            //   '</li>'+
                            // '</ul>'
                              ;          
                          }
                      $('.newItems').html(html);
                    }
                  });
              }