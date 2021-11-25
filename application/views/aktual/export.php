<!-- <div class="table-responsive"> -->
                        <table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>Project</center></th>
                                    <th><center>Bank</center></th>
                                    <th><center>Channel</center></th>
                                    <th><center>Transaksi</center></th>
                                    <th><center>System</center></th>
                                    <th><center>Jenis</center></th>
                                    <?php
                                    foreach ($td as $col) { ?>
                                      <th style="background-color: #90EE90;"><center><?php echo $col['label']; ?></center></th>   
                                     <?php } ?>
                                     <th><center>Total TD</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no=1;
                                $jumlah_td = 0;
                                 foreach ($aktual as $row) {
                                    $detail = $this->db->get_where('ebanking_td', array('num_eb' => $row['num']))->row_array();
                                  ?>
                                <tr>
                                   <td><?php echo $no++; ?></td>
                                   <td><?php echo $row['nama_project']; ?></td>
                                   <td><?php echo $row['nama_bank']; ?></td>
                                   <td><?php echo $row['channel']; ?></td>
                                   <td><?php echo $row['nama_transaksi']; ?></td>
                                   <td><?php echo $row['os']; ?></td>
                                    <td><?php echo $row['jenis']; ?></td>
                                    <?php
                                    foreach ($td as $col) {
                                    $step = $col['step']; ?>
                                      <td><?php echo $detail['step'.$step]; ?></td>   
                                     <?php } ?>
                                    <td><?php echo $row['total_td']; ?></td>
                                     
                                </tr>
                            <?php
                            
                             }
                            
                              ?>
                            </tbody>
                        </table>