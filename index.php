<?php

  $txt = "Ехал Грека через реку. Видит Грека - в реке рак.
  Сунул Грека руку в реку. Рак за руку Греку цап!

  Карл украл у Клары кораллы.
  А Клара украла у Карла кларнет.

  Без труда и пруд-то не найдешь.

  Одна голова - хорошо. Две - Российский герб. А три - Змей Горыныч.

  Алкоголь в малых дозах полезен в любых количествах.

  Есть только миг между прошлым и будущем, именно он называется present continuous.";

  $punkt= ['.', ',', '!', '?', '-', ':', ';', '\r', '\n', '\t'];

  echo 'Исходный текст:<br>';
  var_dump($txt);
  echo '<br>';
  

  // Всю имеющуюся пунктуацию и служебные символы сведем к пробелам
  $txt = str_replace($punkt, " ", $txt);
  
  // Преобразуем в строчные буквы
  $txt = mb_strtolower($txt);

  // Выделим слова
  $words = explode(" ", $txt);

  foreach ($words as $i => $v) {

    $words[$i] = trim($v);
	// Если слово пустое - исключим из массива
    if (empty($words[$i])) {
      unset($words[$i]);
	}
  }

  // Сформируем словарь (массив уникальных слов)
  $dict = array_unique ($words, SORT_LOCALE_STRING);

  echo '<table>';
  echo '<tr> <th> № </th> <th> Слово </th> <th> Количество </tr> </tr>';

  $num = 1;
  foreach ($dict as $i => $v)
  {
	$cnt_rep = 0; // Счетчик повторяющихся слов в тексте
    foreach ($words as $j => $w) if ($v==$w) $cnt_rep++;
//	echo "Слово '$v' повторяется '$cnt_rep' раз";
//	if ( (($cnt_rep % 10) >= 2) && (($cnt_rep % 10) <= 4) )  echo 'a';
//	echo '<br>';
    echo "<tr> <td> $num </td> <td> $v </td> <td> $cnt_rep </td> </tr>";
	$num++;
  }

  $cnt_wrd = count($words);
//  echo "Количество слов в тексте = $cnt_wrd <br>";

  echo "<tr> <td colspan='2'> Всего слов в тексте </td> <td> $cnt_wrd </td>  </tr>";
  echo '</table>';

  
//  echo '<tr> <td> 11 </td> <td> 12 </td> <td> 13 </td> </tr>';
//  echo '<tr> <td> 21 </td> <td> 22 </td> <td> 23 </td> </tr>';

?>