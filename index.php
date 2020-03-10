<?php

header('Content-Type: text/event-stream');

 $txt = 'Ехал Грека через реку. Видит Грека - в реке рак.
  Сунул Грека руку в реку. Рак за руку Греку цап!
  Карл украл у Клары кораллы.
  А Клара украла у Карла кларнет.
  Без труда и пруд-то не найдешь.
  Одна голова - хорошо. Две - Российский герб. А три - Змей Горыныч.
  Алкоголь в малых дозах полезен в любых количествах.
  Есть только миг между прошлым и будущем, именно он называется present continuous.';

	
// Определяет валидность слова
function member($wrd) : int
{
  return empty($wrd) ? 0 : 1;
}

// Синтаксический анализ с выделением слов
function syntax($arg1) : array
{
  static $punkt= ['.', ',', '!', '?', '-', ':', ';', PHP_EOL];
  static $txt_result;
  static $words =[];

  // Всю имеющуюся пунктуацию и служебные символы сведем к пробелам
  $txt_result = str_replace($punkt, " ", $arg1);

  // Преобразуем в строчные буквы
  $txt_result = mb_strtolower($txt_result);

  // Выделим слова
  $words = explode(" ", $txt_result);

  foreach ($words as $i)
  {
    $words[$i] = trim($words[$i]);
  }
  
  // Если слово пустое - исключим из массива
  $words = array_filter($words, "member");

  return $words;
}

// Формирование словаря и статистики 
function tesis($arg1) : array 
{
  static $tes = [];
  static $dict = [];
  $dict = array_unique ($arg1, SORT_LOCALE_STRING);

  foreach ($dict as $d)
  {
	$cnt_rep = 0; // Счетчик повторяющихся слов в тексте
    foreach ($arg1 as $w) 
	{
	  if ($d==$w)
      {
        $cnt_rep++;
	  }
	}
	array_push($tes, "$d:$cnt_rep");
  }
  return $tes;
}
  
//  echo 'Исходный текст:'.PHP_EOL;
//  echo $txt.PHP_EOL;

  $words = syntax($txt);
  $t = tesis($words);
  $cnt_wrd = count($words);

  foreach ($t as $vv)
  {
    echo $vv.PHP_EOL;
  }

  echo "Всего слов:$cnt_wrd".PHP_EOL;
?>