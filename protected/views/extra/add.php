<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Extra Plan</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                New Extra Plan
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="POST" action="<?php echo Yii::app()->baseUrl?>/extra/save">
                        <!-- <div class="col-lg-12"> -->
                            <div class="form-group col-lg-3" >
                                <label>Plot Extra</label>
                                <input class="form-control" name="name"  placeholder="Name" required="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <div class="form-group col-lg-3" >
                                <label>Plot Extra Initial</label>
                                <input class="form-control" name="initial" required="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                        <!-- </div> -->
                        
                        
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                            
                        </form>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

<script type="text/javascript">
    var delay = (function(){
      var timer = 0;
      return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
      };
    })();
    $('.plot_size').keyup(function() {
        delay(function(){
        var size = $('.plot_size').val();
            if(size !=''){
                $('.plot_size').val($('.plot_size').val()+ ' SQ Yrd');
            }
        }, 500 );
    });

</script>
            