     <div class="px-4 max-w-7xl py-6 w">
          <!-- Isi konten halaman di sini -->
          <h1 class="text-2xl font-bold"><?= $_SESSION['user_name'] ?></h1>
          <?php
          date_default_timezone_set('Asia/Jakarta'); // Sesuaikan dengan zona waktu Anda

          if (isset($_SESSION['last_login'])) {
               $lastLoginTime = strtotime($_SESSION['last_login']);
               $currentTime = time();

               $timeDifference = $currentTime - $lastLoginTime;

               // Konversi selisih waktu ke format yang lebih mudah dibaca (misalnya menit)
               $minutesDifference = round($timeDifference / 60);

               if ($minutesDifference < 60) {
                    echo "<p class='text-gray-500'>You last logged in " . $minutesDifference . " minutes ago.</p>";
               } else {
                    $hoursDifference = floor($minutesDifference / 60);
                    $remainingMinutes = $minutesDifference % 60;
                    echo "<p>You last logged in " . $hoursDifference . " hours and " . $remainingMinutes . " minutes ago.</p>";
               }
          }
          ?>


          <div class="banner mt-4">
               <div class="head flex gap-4">
                    <div class="box  rounded-md flex flex-col justify-between w-full h-auto shadow-sm bg-white">
                         <div class="main w-full h-24 p-2 flex justify-between">
                              <div class="left left-0 m-0 flex flex-col">
                                   <?php
                                   foreach ($data['approve'] as $total) {
                                        $member = $total['total_members_count'];
                                        $approve = $total['total_roles_count'];
                                   } ?>
                                   <span class="text-sm font-normal text-gray-500">Anggota Terdaftar</span>

                                   <span class="text-4xl font-bold before:contents-['^'] before:mr-1 before:text-green-500"><?= $approve ?>/<?= $member ?><span></span></span>
                              </div>
                              <div class="right right-0 w-20 h-auto pt-4">
                                   <img class="w-auto" src="<?= BASEURL ?>/img/asset/role.png" alt="">
                              </div>
                         </div>
                         <div class="bottom rounded-b-md bg-red-700 w-full text-center h-2">
                         </div>
                    </div>
                    <div class="box  rounded-md flex flex-col justify-between w-full h-auto shadow-sm bg-white">
                         <div class="main w-full h-24 p-2 flex justify-between">
                              <div class="left left-0 m-0 flex flex-col">
                                   <?php
                                   foreach ($data['approve'] as $total) {
                                        $member = $total['total_members_count'];
                                        $approve = $total['total_roles_count'];
                                   } ?>
                                   <span class="text-sm font-normal text-gray-500">Anggota Terdaftar</span>

                                   <span class="text-4xl font-bold before:contents-['^'] before:mr-1 before:text-green-500"><?= $approve ?>/<?= $member ?><span></span></span>
                              </div>
                              <div class="right right-0 w-20 h-auto pt-4">
                                   <img class="w-auto" src="<?= BASEURL ?>/img/asset/role.png" alt="">
                              </div>
                         </div>
                         <div class="bottom rounded-b-md bg-green-700 w-full text-center h-2">
                         </div>
                    </div>
                    <div class="box  rounded-md flex flex-col justify-between w-full h-auto shadow-sm bg-white">
                         <div class="main w-full h-24 p-2 flex justify-between">
                              <div class="left left-0 m-0 flex flex-col">
                                   <?php
                                   foreach ($data['approve'] as $total) {
                                        $member = $total['total_members_count'];
                                        $approve = $total['total_roles_count'];
                                   } ?>
                                   <span class="text-sm font-normal text-gray-500">Anggota Terdaftar</span>

                                   <span class="text-4xl font-bold before:contents-['^'] before:mr-1 before:text-green-500"><?= $approve ?>/<?= $member ?><span></span></span>
                              </div>
                              <div class="right right-0 w-20 h-auto pt-4">
                                   <img class="w-auto" src="<?= BASEURL ?>/img/asset/role.png" alt="">
                              </div>
                         </div>
                         <div class="bottom rounded-b-md bg-blue-700 w-full text-center h-2">
                         </div>
                    </div>
               </div>
               <div class="chart-body mt-4 flex gap-2">

                    <div class="bg-white shadow-sm chart-container relative h-80 m-0 w-80 p-4">
                         <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="right right-0 w-20 h-auto pt-4">
                         <canvas id="myDonutChart"></canvas>
                    </div>


               </div>

               <!-- Kode JS -->
               <script>
                    <?php
                    // Pastikan $data['chart'] sudah berisi array asosiatif yang sesuai
                    $labels = [];
                    $values = [];
                    foreach ($data['chart'] as $chartData) {
                         $labels[] = $chartData['nama'];
                         $values[] = $chartData['jumlah_anggota'];
                    }
                    ?>

                    // Konversi data PHP ke format JavaScript
                    const labels = <?php echo json_encode($labels); ?>;
                    const data = <?php echo json_encode($values); ?>;

                    const ctx = document.getElementById('myPieChart').getContext('2d');
                    const myPieChart = new Chart(ctx, {
                         type: 'pie',
                         data: {
                              labels: labels,
                              datasets: [{
                                   data: data,
                                   backgroundColor: ['#FG6384', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
                              }]
                         },
                         options: {
                              responsive: true,
                              plugins: {
                                   legend: {
                                        position: 'top',
                                   },
                                   tooltip: {
                                        enabled: true
                                   }
                              }
                         }
                    });
               </script>
          </div>

     </div>