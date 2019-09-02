<div class="container mt-5">

  <div class="row">

    <div class="col-md-12">
        <div class="card py-5 unique-color">

            <div class="card-block">
                <h4 class="card-title text-center">Search Your Service</h4>
                <form action="search.php" method="POST">
                     <div class="row">
                        <div class="col-md-5 ml-auto">
                            <select class="form-control" name="area">
                                <option value="" selected>Choose Area</option>
                                <?php
                                $getAllArea = $service->getAllArea();
                                if($getAllArea){
                                    while ($value = $getAllArea->fetch_assoc()) { ?>

                                        <option value="<?php echo $value['area']; ?>"><?php echo $value['area']; ?></option>

                                    <?php } } ?>
                                </select>
                        </div>
                        <div class="col-md-5 mr-auto">
                            <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">service</span>
                                </div>
                                <input name="q" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
                       <div class="col-md-10 mx-auto">
                            <input type="submit" value="Search" name="search" class="btn btn-dark">
                       </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>

</div>


