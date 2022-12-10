  
<section class="recipe_section layout_padding-top">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Best Popular Recipes
        </h2>
      </div>
      <div class="row">
        <?php
        foreach($allpro as $p)
        {
        ?>
        <div class="col-sm-6 col-md-4 mx-auto">
          <div class="box">
            <div class="img-box">
              <img src="../admin-delfood/upload/<?php echo $p->pro_img;?>" class="box-img" alt="">
            </div>
            <div class="detail-box">
              <h4>
                <?php echo $p->pro_name;?> 
              </h4>
              <p><?php echo $p->pro_desc;?></p>
              <span><?php echo $p->pro_price; ?></span>
              <form method="post">
              <p><input type="text" name="qty" ></p>
              <input type="hidden" name="pid" value="<?php echo $p->pro_id;?>">
              <div>
                <button class="btn bg-primary py-2 px-3" name="addtocart" type="submit">Add to cart</button>
              </div>
            </div>
          </div>
          </form>
        </div>
        <?php
        }
        ?>
      </div>
      <div class="btn-box">
        <a href="">
          Order Now
        </a>
      </div>
    </div>
  </section>
         
           
                
        <?php
                 //}
                 ?>
    
    
    
    <!-- <a href="#" class="boxed-btn3" align="center">Order Now</a> -->
    
    <!-- best_burgers_area_end  -->