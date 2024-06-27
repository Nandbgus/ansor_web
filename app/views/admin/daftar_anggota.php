 <div class="container mx-auto px-4">
     <h1 class="text-2xl font-bold my-4">Halaman Daftar Anggota</h1>
     <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 bg-white rounded-md shadow">
         <div class="overflow-x-auto">
             <table id="example" class="min-w-full bg-white divide-y divide-gray-200 rounded-lg display printable">
                 <thead class="bg-gray-500">
                     <tr>
                         <th class="px-6 py-3 border border-gray-300 text-left text-xs font-medium text-gray-600 uppercase">No</th>
                         <th class="px-6 py-3 border border-gray-300 text-left text-xs font-medium text-gray-600 uppercase">Nama Anggota</th>
                         <th class="px-6 py-3 border border-gray-300 text-left text-xs font-medium text-gray-600 uppercase">No Hp</th>
                         <th class="px-6 py-3 border border-gray-300 text-left text-xs font-medium text-gray-600 uppercase">Dusun</th>
                         <th class="px-6 py-3 border border-gray-300 text-left text-xs font-medium text-gray-600 uppercase">Desa</th>
                         <th class="px-6 py-3 border border-gray-300 text-left text-xs font-medium text-gray-600 uppercase">RT</th>
                         <th class="px-6 py-3 border border-gray-300 text-left text-xs font-medium text-gray-600 uppercase">Status Anggota</th>
                         <th class="px-6 py-3 border border-gray-300 text-left text-xs font-medium text-gray-600 uppercase">Aksi</th>
                     </tr>
                 </thead>
                 <tbody class="bg-white divide-y divide-gray-200 text-center">
                     <?php if (!empty($data['members'])) : ?>
                         <?php foreach ($data['members'] as $index => $anggota) : ?>
                             <tr class="hover:bg-gray-50">
                                 <td class="px-6 py-4 border border-gray-300 whitespace-nowrap text-sm text-gray-900"><?= $index + 1 ?></td>
                                 <td class="px-6 py-4 border border-gray-300 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($anggota['nama_a'], ENT_QUOTES, 'UTF-8') ?></td>
                                 <td class="px-6 py-4 border border-gray-300 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($anggota['no_hp'], ENT_QUOTES, 'UTF-8') ?></td>
                                 <td class="px-6 py-4 border border-gray-300 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($anggota['nama_dusun'], ENT_QUOTES, 'UTF-8') ?></td>
                                 <td class="px-6 py-4 border border-gray-300 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($anggota['nama_desa'], ENT_QUOTES, 'UTF-8') ?></td>
                                 <td class="px-6 py-4 border border-gray-300 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($anggota['rt'], ENT_QUOTES, 'UTF-8') ?></td>
                                 <td class="px-6 py-4 border border-gray-300 whitespace-nowrap text-sm text-gray-900">
                                     <?php if ($anggota['status_verif'] === 'pending') : ?>
                                         <?= htmlspecialchars($anggota['nama_keanggotaan']) ?> <span class="status-pending text-blue-500">(pending)</span>
                                     <?php elseif ($anggota['status_verif'] === 'approve') : ?>
                                         <?= htmlspecialchars($anggota['nama_keanggotaan']) ?>
                                     <?php else : ?>
                                         Tidak ada status
                                     <?php endif; ?>
                                 </td>
                                 <td class="px-6 py-4 border border-gray-300 whitespace-nowrap text-sm font-medium">
                                     <button type="button" onclick="viewMember('<?= $anggota['id_member'] ?>')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-500 hover:bg-green-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-700 transition duration-150 ease-in-out">
                                         View
                                     </button>
                                 </td>
                             </tr>
                         <?php endforeach; ?>
                     <?php else : ?>
                         <tr>
                             <td colspan="8" class="px-6 py-4 border border-gray-300 text-sm font-medium text-gray-900 text-center">No data available</td>
                         </tr>
                     <?php endif; ?>
                 </tbody>
             </table>
             <form id="memberForm" action="<?= BASEURL ?>/profile/showMemberProfile" method="POST" style="display: none;">
                 <input type="hidden" name="id_member" id="id_member_input">
             </form>
         </div>
     </div>
 </div>