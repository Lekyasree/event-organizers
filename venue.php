<?php 
include 'admin/db_connect.php'; 
?>
<style>
#portfolio .img-fluid{
    width: calc(100%);
    height: 30vh;
    z-index: -1;
    position: relative;
    padding: 1em;
}
.venue-list{
cursor: pointer;
border: unset;
flex-direction: inherit;
}
.venue-list .carousel,.venue-list .card-body {
    width: calc(50%)
}
.venue-list .carousel img.d-block.w-100 {
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    min-height: 50vh;
}
span.hightlight{
    background: yellow;
}
.carousel,.carousel-inner,.carousel-item{
   min-height: calc(100%)
}
header.masthead,header.masthead:before {
        min-height: 50vh !important;
        height: 50vh !important
    }
.row-items{
    position: relative;
}
.card-left{
    left:0;
}
.card-right{
    right:0;
}
.rtl{
    direction: rtl ;
}
.venue-text{
    justify-content: center;
    align-items: center ;
}

</style>
        <header class="masthead">
        </header>
            <div class="container-fluid mt-3 pt-2">
                <h4 class="text-center text-white">List of Our Event Venues</h4>
                <hr class="divider">
                <div class="row-items">
                <div class="col-lg-12">
                    <div class="row">
                <?php
                $rtl ='rtl';
                $ci= 0;
                $venue = $conn->query("SELECT * from venue order by rand()");
                while($row = $venue->fetch_assoc()):
                   
                    $ci++;
                    if($ci < 3){
                        $rtl = '';
                    }else{
                        $rtl = 'rtl';
                    }
                    if($ci == 4){
                        $ci = 0;
                    }
                ?>
                <div class="col-md-6">
                <div class="card venue-list <?php echo $rtl ?>" data-id="<?php echo $row['id'] ?>">

                        <div id="imagesCarousel_<?php echo $row['id'] ?> card-img-top " class="carousel slide" data-ride="carousel">
                            <?php ?>
                              <div class="carousel-inner">
                              
                                    <?php 
                                        $images = array();
                                        $fpath = 'admin/assets/uploads/venue_'.$row['id'];
                                        $images= scandir($fpath);
                                        $i = 1;
                                        foreach($images as $k => $v):
                                            if(!in_array($v,array('.','..'))):
                                                $active = $i == 1 ? 'active' : '';
                                            
                                    ?>
                                         <div class="carousel-item <?php echo $active ?>">
                                          <img class="d-block w-100" src="<?php echo $fpath.'/'.$v ?>" alt="">
                                        </div>
                                    <?php
                                            $i++;
                                            else:
                                                unset($images[$v]);
                                            endif;
                                        endforeach;
                                    ?>
                                     <a class="carousel-control-prev" href="#imagesCarousel_<?php echo $row['id'] ?>" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                      </a>
                                      <a class="carousel-control-next" href="#imagesCarousel_<?php echo $row['id'] ?>" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                      </a>
                                        </div>
                                    </div>
                    <div class="card-body">
                        <div class="row align-items-center justify-content-center text-center h-100">
                            <div class="">
                                <div>
                                    <h3><b class="filter-txt"><?php echo ucwords($row['venue']) ?></b></h3>
                                    <small><i><?php echo $row['address'] ?></i></small>
                                </div>
                                <div>
                                <span class="truncate" style="font-size: inherit;"><small><?php echo ucwords($row['description']) ?></small></span>
                                    <br>
                                <span class="badge badge-secondary"><i class="fa fa-tag"></i> Rate Per Hour: <?php echo number_format($row['rate'],2) ?></span>
                                <br>
                                <br>
                                <button class="btn btn-primary book-venue align-self-end" type="button" data-id='<?php echo $row['id'] ?>'>Book</button>
                                </div>
                            </div>
                        </div>
                        

                    </div>
                </div>
                <br>
                </div>
                <?php endwhile; ?>
                </div>
                </div>
                </div>
            </div>


<script>
    // $('.card.venue-list').click(function(){
    //     location.href = "index.php?page=view_venue&id="+$(this).attr('data-id')
    // })
    $('.book-venue').click(function(){
        uni_modal("Submit Booking Request","booking.php?venue_id="+$(this).attr('data-id'))
    })
    $('.venue-list .carousel img').click(function(){
        viewer_modal($(this).attr('src'))
    })

</script>