<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>WW Surge 21 KV</title>
  </head>
  <body>
    <h1>High Voltage Surge Arrester - 21kV</h1>
    <table>
      <thead>
        <tr>
          <td>k/i</td>
          <?php
          for ($i = 1; $i <= 12; $i++) {
            echo sprintf('<td>%d</td>', $i);
          }
          ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <?php
          require('./lk_12month.php');

          $k = 1;

          for ($i = 1; $i <= 12; $i++) {
            $hvsa = new HighVoltageSurgeArrester($lk_12month);
            echo sprintf('<td>%d</td>', $hvsa->calculate($i, $k));
          }
          ?>
        </tr>
      </tbody>
    </table>

    <h1>Simu for lk</h1>
    <table>
      <thead>
        <tr>
          <td></td>
          <?php
          for ($i = 1; $i <= 12; $i++) {
            echo sprintf('<td>%d</td>', $i);
          }
          ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>ความต้องการ</td>
          <?php
          require('./demand.php');
          for ($month = 1; $month <= 12; $month++) {
            echo sprintf('<td>%d</td>', $lk_12month[$month]->demand);
          }
          ?>
        </tr>
        <tr>
          <td>ปริมาณการสั่ง (Q)</td>
          <?php
          require('./demand.php');
          for ($month = 1; $month <= 12; $month++) {
            echo sprintf('<td>%d</td>', $lk_12month[$month]->quantity);
          }
          ?>
        </tr>
        <tr>
          <td>สินค้าคงคลังต้นงวด</td>
          <?php
          require('./demand.php');
          for ($month = 1; $month <= 12; $month++) {
            echo sprintf('<td>%d</td>', $lk_12month[$month]->beginning_inventory);
          }
          ?>
        </tr>
        <tr>
          <td>สินค้าคงคลังปลายงวด</td>
          <?php
          require('./demand.php');
          for ($month = 1; $month <= 12; $month++) {
            echo sprintf('<td>%d</td>', $lk_12month[$month]->ending_inventory);
          }
          ?>
        </tr>
        <tr>
          <td>สินค้าคงคลังถัวเฉลี่ย</td>
          <?php
          require('./demand.php');
          for ($month = 1; $month <= 12; $month++) {
            echo sprintf('<td>%d</td>', $lk_12month[$month]->average_inventory);
          }
          ?>
        </tr>
        <tr>
          <td>ค่าใช้จ่ายในการถือครอง</td>
          <?php
          require('./demand.php');
          for ($month = 1; $month <= 12; $month++) {
            echo sprintf('<td>%d</td>', $lk_12month[$month]->round_holding_cost);
          }
          ?>
        </tr>
        <tr>
          <td>คค่าใช้จ่ายในการสั่ง (คงที่)</td>
          <?php
          require('./demand.php');
          for ($month = 1; $month <= 12; $month++) {
            echo sprintf('<td>%d</td>', $lk_12month[$month]->ordering_cost);
          }
          ?>
        </tr>
      </tbody>
    </table>
  </body>
</html>
