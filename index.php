<?php

header('Content-Type: text/event-stream');
	
// Определяет валидность слова
function member($wrd)
{
  return empty($wrd) ? 0 : 1;
}
  $txt = "Ехал Грека через реку. Видит Грека - в реке рак.
  Сунул Грека руку в реку. Рак за руку Греку цап!
  Карл украл у Клары кораллы.
  А Клара украла у Карла кларнет.
  Без труда и пруд-то не найдешь.
  Одна голова - хорошо. Две - Российский герб. А три - Змей Горыныч.
  Алкоголь в малых дозах полезен в любых количествах.
  Есть только миг между прошлым и будущем, именно он называется present continuous.";

  $punkt= ['.', ',', '!', '?', '-', ':', ';', PHP_EOL];

  echo 'Исходный текст:'.PHP_EOL;
  echo $txt.PHP_EOL;
  

  // Всю имеющуюся пунктуацию и служебные символы сведем к пробелам
  $txt = str_replace($punkt, " ", $txt);
  
  // Преобразуем в строчные буквы
  $txt = mb_strtolower($txt);

  // Выделим слова
  $words = explode(" ", $txt);

  foreach ($words as $i)
  {
    $words[$i] = trim($words[$i]);
  }

  // Если слово пустое - исключим из массива
  $words = array_filter($words, "member");

  // Сформируем словарь (массив уникальных слов)
  $dict = array_unique ($words, SORT_LOCALE_STRING);
  
  foreach ($dict as $i => $v)
  {
	$cnt_rep = 0; // Счетчик повторяющихся слов в тексте
    foreach ($words as $j => $w) 
	{
	  if ($v==$w)
      {
        $cnt_rep++;
	  }
	}
    echo "$v:$cnt_rep".PHP_EOL;
  }

  $cnt_wrd = count($words);
  echo "Всего слов:$cnt_wrd".PHP_EOL;
?>