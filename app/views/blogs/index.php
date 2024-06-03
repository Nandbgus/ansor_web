<div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 ">
    <div class="grid grid-cols-3 gap-4">
        <?php foreach ($data['isi'] as $isi) : ?>
            <div class=" p-6 rounded-lg shadow-md border tracking-normal">
                <h2 class="text-3xl font-bold mb-4">
                    <?= $isi["judul"] ?>
                </h2>
                <p class="text-gray-600 text-sm mb-4">Ditulis oleh <span class="font-semibold text-blue-700"><?= $isi["author"] ?></span> | <span class="font-semibold"><?= $isi["time_stamp"] ?></span></p>
                <p class="text-gray-700"><?= $isi["body"] ?>
            </div>
        <?php endforeach ?>
    </div>
</div>