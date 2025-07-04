<?php

include "header.php";
include "hdl/stock.hdl.php";

?>

  <main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-md-3">
                  <h5 class="card-title f-header">ສະຫຼຸບເຄື່ອງໃນຫ້ອງພັກ</h5>
                  </div>
                  <div class="col-md-9">
                    <div class="row justify-content-md-end">
                    <a href="w_vacant_main.php"  class="btn btn-outline btn-color btn-in-table p-2 col-md-3">ກັບຄືນ</a>        
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable table-hover table-striped">
                  <thead>
                    <tr>
                      <th>ເຄື່ອງໃຊ້</th>
                      <th>ປະເພດ</th>
                      <th>ຈຳນວນ</th>
                      <th>101</th>
                      <th>102</th>
                      <th>103</th>
                      <th>104</th>
                      <th>105</th>
                      <th>106</th>
                      <th>201</th>
                      <th>202</th>
                      <th>203</th>
                      <th>204</th>
                      <th>205</th>
                      <th>206</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($row=mysqli_fetch_array($room_item)){?>
                    <tr>
                      <td><?php echo $row['item_la'];?></td>
                      <td><?php 
                      
                        if($row['cat_id'] == 1){
                          echo 'ເຄື່ອງໃຊ້ໄຟຟ້າ';
                        } elseif ($row['cat_id'] == 2){
                          echo 'ເຄື່ອງຄົວ';
                        } elseif ($row['cat_id'] == 3){
                          echo 'ຫ້ອງນອນ';
                        } elseif ($row['cat_id'] == 4){
                          echo 'ກ່ຽວກັບນ້ຳ';
                        } elseif ($row['cat_id'] == 5){
                          echo 'ອຸປະກອນທົ່ວໄປ';
                        }
                      
                      ?></td>
                      <td><?php 
                      if($row['base_unit'] > 0){
                        echo '<span class="badge bg-info">';
                        echo number_format($row['base_unit']);
                        echo '</span>';
                      }
                      ?></td>
                      <td><?php 
                       if($row['base_unit'] == $row['r101']){
                        echo '<span class="badge bg-success">';
                        echo number_format($row['r101']);
                        echo '</span>';
                        } else {
                        echo '<span class="badge bg-danger">';
                        echo number_format($row['r101']);
                          echo '</span>';
                        } 
                      ?></td>
                      <td><?php 
                       if($row['base_unit'] == $row['r102']){
                        echo '<span class="badge bg-success">';
                        echo number_format($row['r102']);
                        echo '</span>';
                        } else {
                        echo '<span class="badge bg-danger">';
                        echo number_format($row['r102']);
                          echo '</span>';
                        } 
                      ?></td>
                      <td><?php 
                       if($row['base_unit'] == $row['r103']){
                        echo '<span class="badge bg-success">';
                        echo number_format($row['r103']);
                        echo '</span>';
                        } else {
                        echo '<span class="badge bg-danger">';
                        echo number_format($row['r103']);
                          echo '</span>';
                        } 
                      ?></td>
                      <td><?php 
                       if($row['base_unit'] == $row['r104']){
                        echo '<span class="badge bg-success">';
                        echo number_format($row['r104']);
                        echo '</span>';
                        } else {
                        echo '<span class="badge bg-danger">';
                        echo number_format($row['r104']);
                          echo '</span>';
                        } 
                      ?></td>
                      <td><?php 
                       if($row['base_unit'] == $row['r105']){
                        echo '<span class="badge bg-success">';
                        echo number_format($row['r105']);
                        echo '</span>';
                        } else {
                        echo '<span class="badge bg-danger">';
                        echo number_format($row['r105']);
                          echo '</span>';
                        } 
                      ?></td>
                      <td><?php 
                       if($row['base_unit'] == $row['r106']){
                        echo '<span class="badge bg-success">';
                        echo number_format($row['r106']);
                        echo '</span>';
                        } else {
                        echo '<span class="badge bg-danger">';
                        echo number_format($row['r106']);
                          echo '</span>';
                        } 
                      ?></td>
                      <td><?php 
                       if($row['base_unit'] == $row['r201']){
                        echo '<span class="badge bg-success">';
                        echo number_format($row['r201']);
                        echo '</span>';
                        } else {
                        echo '<span class="badge bg-danger">';
                        echo number_format($row['r201']);
                          echo '</span>';
                        } 
                      ?></td>
                      <td><?php 
                       if($row['base_unit'] == $row['r202']){
                        echo '<span class="badge bg-success">';
                        echo number_format($row['r202']);
                        echo '</span>';
                        } else {
                        echo '<span class="badge bg-danger">';
                        echo number_format($row['r202']);
                          echo '</span>';
                        } 
                      ?></td>
                      <td><?php 
                       if($row['base_unit'] == $row['r203']){
                        echo '<span class="badge bg-success">';
                        echo number_format($row['r203']);
                        echo '</span>';
                        } else {
                        echo '<span class="badge bg-danger">';
                        echo number_format($row['r203']);
                          echo '</span>';
                        } 
                      ?></td>
                      <td><?php 
                       if($row['base_unit'] == $row['r204']){
                        echo '<span class="badge bg-success">';
                        echo number_format($row['r204']);
                        echo '</span>';
                        } else {
                        echo '<span class="badge bg-danger">';
                        echo number_format($row['r204']);
                          echo '</span>';
                        } 
                      ?></td>
                      <td><?php 
                       if($row['base_unit'] == $row['r205']){
                        echo '<span class="badge bg-success">';
                        echo number_format($row['r205']);
                        echo '</span>';
                        } else {
                        echo '<span class="badge bg-danger">';
                        echo number_format($row['r205']);
                          echo '</span>';
                        } 
                      ?></td>
                      <td><?php 
                        if($row['base_unit'] == $row['r206']){
                          echo '<span class="badge bg-success">';
                          echo number_format($row['r206']);
                          echo '</span>';
                        } else {
                          echo '<span class="badge bg-danger">';
                          echo number_format($row['r206']);
                          echo '</span>';
                        } 
                      ?></td>
                      
                    </tr>
                    <?php }?>
                    
                  </tbody>
                </table>
              </div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

<?php

include "footer.php";

?>