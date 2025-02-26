<script type="text/javascript" src="https://unpkg.com/dayjs@1.11.8/dayjs.min.js"></script>
<?php
require 'sbrf.php';

$valutes = get_valutes();
preg_match('/<Name\>Китайский юань<\/Name><Value>([\d+,]*?)<\/Value>/', $valutes, $matches);
if ($matches) {
?>
<script type="text/javascript">
  window.valutes = <?php print "'$matches[1]'" ?>;
  0133133;
</script>
<?php
}
?>


<div id="calc-body">
  <a name="calc-leasing"></a>
  <section id="calc-leasing">

    <hr>

    <div class="block-calc">
      <label class="" for="amount">Стоимость лизинга, ₽</label>
      <input type="text" id="amount" name="amount" value="10 000 000">
      <input type="range" id="amount-range" step="10000" min="500000" max="15000000" value="10000000" style="">
      <div class="values">
        <span>500 000 ₽</span>
        <span id="amount-range-max"></span>
      </div>
    </div>

    <div class="block-calc">
      <label class="" for="prepay">Аванс, ₽</label>
      <input type="text" id="prepay" name="prepay" value="2 000 000">
      <input type="text" id="prepay-percent" name="prepay-percent" value="20" style="width: 26px;"><span>%</span>
      <input type="range" id="prepay-range" step="1" min="1" max="50" value="20" style="">
      <div class="values">
        <span>1%</span>
        <span>50%</span>
      </div>
    </div>

    <div class="block-calc">
      <label class="" for="duration">Срок лизинга</label>
      <input type="text" id="duration" name="duration" value="36"><span> мес.</span>
      <input type="range" id="duration-range" step="1" min="12" max="84" value="36" style="">
      <div class="values">
        <span>12 мес. (1 год)</span>
        <span>84 мес. (7 лет)</span>
      </div>
    </div>

    <hr>

    <!-- <div class="block-result">
      <h2>Результат расчета</h2>
      <span>Сумма договора лизинга</span>
      <div id="result"></div>
    </div> -->
  </section>

  <section id="form-calc">
    Для заключения договора лизинга нам нужны ваши данные.
    <br><br>
    <form method="post" action="/wp-content/plugins/calc-leasing/receive.php">
      <label class="" for="first-name">* Имя</label>
      <input type="text" id="first-name" name="first-name" required>
      <label class="" for="middle-name">* Отчество</label>
      <input type="text" id="middle-name" name="middle-name" required>
      <label class="" for="last-name">* Фамилия</label>
      <input type="text" id="last-name" name="last-name" required>
      <label class="" for="inn">* ИНН</label>
      <input type="text" id="inn" name="inn" required>
      <label class="" for="phone">* Телефон</label>
      <input type="text" id="phone" name="phone" required>
      <label class="" for="email">Е-майл (не обязательно)</label>
      <input type="text" id="email" name="email">
      <label type="textarea" for="comment">Комментарий</label>
      <textarea id="comment" name="comment"></textarea>
      <input type="submit" value="Отправить ">

      <!-- <input type="text" name="product-name" value="" />
            <input type="text" name="f-amount" value="" />
            <input type="text" name="f-prepaid" value="" />
            <input type="text" name="f-duration" value="" /> -->
    </form>

  </section>

</div>

<!--
  <input type="text" data-format="(***) ***-****" data-mask="(###) ###-####">
  <input type="text" data-format="**.**.****" data-mask="MM.DD.YYYY">
  <input type="text" data-format="+* (***) ***-**-**" data-mask="+* (***) ***-**-**" />
  <input type="text" data-format="*** *** ***" data-mask="" />
-->