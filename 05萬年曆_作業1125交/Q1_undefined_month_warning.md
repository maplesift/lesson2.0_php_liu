
```php
  <?php
    // 取得當前月份
if (in_array($_GET['month'], [12, 1, 2])) {
    $seasonClass = "winter";
} elseif (in_array($_GET['month'], [3, 4, 5])) {
    $seasonClass = "spring";
} elseif (in_array($_GET['month'], [6, 7, 8])) {
    $seasonClass = "summer";
} else {
    $seasonClass = "autumn";
}
?>
```
請問第一次開啟會出錯
Warning: Undefined array key "month"
該怎麼解決?

# 解決 `Warning: Undefined array key "month"` 問題


### **2. 設定預設值**

假設當 `$_GET['month']` 未定義時，想使用當前月份作為預設值。

```php
<?php
$month = isset($_GET['month']) ? $_GET['month'] : date('n'); // 預設為當前月份
if (in_array($month, [12, 1, 2])) {
    $seasonClass = "winter";
} elseif (in_array($month, [3, 4, 5])) {
    $seasonClass = "spring";
} elseif (in_array($month, [6, 7, 8])) {
    $seasonClass = "summer";
} else {
    $seasonClass = "autumn";
}
?>
```

- 使用三元運算子 `isset($_GET['month']) ? $_GET['month'] : date('n')`：
  - 如果 `$_GET['month']` 存在，使用其值；
  - 否則，使用 `date('n')` 獲取當前月份。

---

### **3. 使用 `filter_input` 方法**

這種方法更安全，因為它可以避免未定義的警告。

```php
<?php
$month = filter_input(INPUT_GET, 'month', FILTER_VALIDATE_INT) ?: date('n'); // 預設為當前月份
if (in_array($month, [12, 1, 2])) {
    $seasonClass = "winter";
} elseif (in_array($month, [3, 4, 5])) {
    $seasonClass = "spring";
} elseif (in_array($month, [6, 7, 8])) {
    $seasonClass = "summer";
} else {
    $seasonClass = "autumn";
}
?>
```
- `filter_input(INPUT_GET, 'month', FILTER_VALIDATE_INT)`:

- 從 `HTTP GET` 請求中獲取 `month` 的值。
使用 `FILTER_VALIDATE_INT` 過濾器來確保值為有效整數。如果 `month` 存在且有效，返回整數值；否則返回 `false`。
?: (簡化運算符):

如果 `filter_input` 返回 `false`（`month` 不存在或無效），則使用右側的值：`date('n')`。
`date('n')`: 獲取當前的月份（1 到 12 的整數）。
結果:

$month 的值將是有效的 $_GET['month'] 或當前月份。


- `filter_input(INPUT_GET, 'month', FILTER_VALIDATE_INT)`：
  - 嘗試從 `$_GET` 中讀取 `month` 並驗證是否為整數；
  - 如果不存在或無效，返回 `false`。
- `?:` 是 PHP 的簡化運算符，當 `filter_input` 返回 `false` 時，會使用右側的值（這裡是 `date('n')`）。
