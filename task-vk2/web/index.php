<?php
interface TimeToWordConvertingInterface {
    public function convert(int $hours, int $minutes): string;
}

class TimeToWordConverter implements TimeToWordConvertingInterface {
    
    /*
    Перевод чисел в текст в разных склонениях или только в И.п.: 
    1 => И.п. муж. род, 
    2 => И.п. жен. род,
    3 => Р.п. число
    4 => Р.п. порядковое число
    5 => id правильного склонения минут для данного числа (по умолчанию 1)
    5 => id правильного склонения часов для данного числа (по умолчанию 1)
    */
    private $numbers = [
        0 => "",
        1 =>  [1 => 'один',     2 => 'одна',    3 => 'одного',      4 => 'первого',     5 => 2, 6 => 2], 
        2 =>  [1 => 'два',      2 => 'две',     3 => 'двух',        4 => 'второго',     5 => 3, 6 => 3], 
        3 =>  [1 => 'три',                      3 => 'трёх',        4 => 'третьего',    5 => 3, 6 => 3],
        4 =>  [1 => 'четыре',                   3 => 'четырёх',     4 => 'четвёртого',  5 => 3, 6 => 3],
        5 =>  [1 => 'пять',                     3 => 'пяти',        4 => 'пятого'],
        6 =>  [1 => 'шесть',                    3 => 'шести',       4 => 'шестого'],
        7 =>  [1 => 'семь',                     3 => 'семи',        4 => 'седьмого'], 
        8 =>  [1 => 'восемь',                   3 => 'восьми',      4 => 'восьмого'], 
        9 =>  [1 => 'девять',                   3 => 'девяти',      4 => 'девятого'], 
        10 => [1 => 'десять',                   3 => 'десяти',      4 => 'десятого'], 
        11 => [1 => 'одиннадцать',              3 => 'одиннадцати', 4 => 'одиннадцатого'],
        12 => [1 => 'двенадцать',               3 => 'двенадцати',  4 => 'двенадцатого'], 

        13 => 'тринадцать', 14 => 'четырнадцать', 15 => 'пятнадцать',
        16 => 'шестнадцать', 17 => 'семнадцать', 18 => 'восемнадцать', 19 => 'девятнадцать',
        20 => 'двадцать', 30 => 'тридцать', 40 => 'сорок', 50 => 'пятьдесят'
    ];

    // Склонения минут
    private $declinationMinutes = [1 =>  "минут", 2 =>  "минута", 3 =>  "минуты"];
    // Склонения часов
    private $declinationHours = [1 =>  "часов", 2 =>  "час", 3 => "часа"];

    // Выборка из массива чисел по самому числу (number) и типу склонения (declination)
    private function selectFromNumbersArray(int $number, int $declination = 1): string{
        if(is_array($this->numbers[$number]))
            if(array_key_exists($declination ,$this->numbers[$number]))
                return $this->numbers[$number][$declination];
            else
            return $this->numbers[$number][1];
        else
        return $this->numbers[$number];
    }

    // Выборка корректного склонения часов или минут по самому числу (number) и типу склоняемого слова (type)
    // Например, тип 5 для минут и 6 для часов
    private function selectCorrectWord(int $number, int $type): string{
        $key = $this->selectFromNumbersArray($number, $type);
        if($type == 5)
            if(array_key_exists($key ,$this->declinationMinutes))
                return $this->declinationMinutes[$key];
            else
                return $this->declinationMinutes[1];
        elseif($type == 6 && array_key_exists($key ,$this->declinationHours))
            return $this->declinationHours[$key];
        return $this->declinationHours[1];
    }
    
    public function convert(int $hours, int $minutes): string {
        if($hours < 1 || $hours > 12 || $minutes < 0 || $minutes > 59)
            return "ERROR";

        $endWord = '';
        if ($minutes == 0) {
            $endWord = $this->selectFromNumbersArray($hours % 13)." ".$this->selectCorrectWord($hours, 6);
        }elseif($minutes == 15) {
            $endWord = "четверть ".$this->selectFromNumbersArray($hours % 13, 4);
        }elseif ($minutes == 30) {
            $endWord = "половина ".$this->selectFromNumbersArray($hours % 13, 4);
        }else{
            if($minutes < 30) {
                $betweenWord = 'после';
            }else{
                $betweenWord = 'до';
                ($hours == 12 ? $hours = 1 : $hours++);
                $minutes = 60 - $minutes;
            }
            $hoursWords = $this->selectFromNumbersArray($hours % 13, 3);
            if($minutes / 20 < 1){
                $minuteWords = $this->selectFromNumbersArray($minutes, 2);
            }else
                $minuteWords = $this->selectFromNumbersArray(floor($minutes / 10) * 10)." "
                    .$this->selectFromNumbersArray($minutes % 10, 2);
            $endWord = $minuteWords." ".$this->selectCorrectWord($minutes % 20, 5)." ".$betweenWord." ".$hoursWords;
        }
        
        $endWord = mb_strtoupper(mb_substr($endWord, 0, 1)).mb_substr($endWord, 1);
        return $endWord.".";
    }
}

$converter = new TimeToWordConverter();
echo "7:00 - ".$converter->convert(7, 0)."<br>"; // Семь часов.
echo "7:01 - ".$converter->convert(7, 1)."<br>"; // Одна минута после семи.
echo "7:03 - ".$converter->convert(7, 3)."<br>"; // Три минуты после семи.
echo "7:12 - ".$converter->convert(7, 12)."<br>"; // Двенадцать минут после семи.
echo "7:15 - ".$converter->convert(7, 15)."<br>"; // Четверть восьмого.
echo "7:22 - ".$converter->convert(7, 22)."<br>"; // Двадцать две минуты после семи.
echo "7:30 - ".$converter->convert(7, 30)."<br>"; // Половина восьмого.
echo "7:35 - ".$converter->convert(7, 35)."<br>"; // Двадцать пять минут до восьми.
echo "7:41 - ".$converter->convert(7, 41)."<br>"; // Девятнадцать минут до восьми.
echo "7:56 - ".$converter->convert(7, 56)."<br>"; // Четыре минуты до восьми.
echo "7:59 - ".$converter->convert(7, 59)."<br>"; // Одна минута до восьми.