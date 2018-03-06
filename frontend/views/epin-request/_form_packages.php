<?php
for ($i = 1; $i <= $number_of_pin; $i++) {
    ?>
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label" for="epinrequest-type">Package <?= $i ?></label>
            <select id="package-<?= $i ?>" class="form-control package-detail" name="package[<?= $i ?>]" data-amount="" aria-required="true" aria-invalid="false" required>
                <option value="">select package</option>
                <?php foreach ($packages as $value) { ?>
                    <option value = "<?= $value->id ?>" data-val="<?= $value->amount ?>" ><?= $value->name . ' - ' . $value->amount ?></option>
                <?php }
                ?>
            </select>
        </div>
    </div>
    <?php
}
?>