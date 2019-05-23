@include('simple_html_dom');include('simple_html_dom');
@php
    //$url = 'http://thethao.vnexpress.net/photo/hau-truong/hom-nay-hoang-xuan-vinh-ve-nuoc-nguyen-tien-minh-quyet-dau-lin-dan-3452035.html';
    //$html = file_get_html($url);
    //$html->find('.block_thumb_slide_show',0)->outertext='';
   // dd($html->find('img'));
   //foreach($html->find('img') as $element) {
   //dd($element);
    // echo '<img src="'.$element->src.'" /><br>';
   //}
   // $html->load($html ->save());
    //$tieude = $html->find('.title_news',0);
    //$noidung = $html->find('#article_content',0);
    $str = 'areetuts.net is a website free for you';
    //chen gạch chéo có 2 parameter
    $newStr = addcslashes($str, 'a..z').'<br />';
    echo $newStr;
    //chèn gạch chéo có 1 parameter
    //echo addslashes($str).'<br />';

    //Hàm này ngược với hàm addslashes, nó xóa các ký tự \ trong chuỗi $str.
    //echo stripcslashes('Hexallo').'<br />';
    //Hàm này sẽ chuyển chuỗi $str thành một dãy số nguyên (có thể âm hoặc dương tùy theo hệ điều hành).
    //echo crc32($str)
    //Hàm này sẽ chuyển một chuỗi $string thành một mảng các phần tử với ký tự tách mảng là $delimiter.
    //var_dump(explode('.', $str));
    //Hàm này ngược với hàm explode, nó chuyển một mảng $piecesarray thành chuỗi và mỗi phần tử cách nhau bởi chuỗi $delimiter
    $arr = [
      '1' => 'cuong',
      '2' => 'hung'
    ];
    //var_dump(implode($arr));
    //Hàm này trả về mã ASCII của ký tự đầu tiên trong chuỗi $string.
    //echo ord($str);
    //Hàm này đếm số ký tự của chuỗi $string.
    //echo strlen($str);
    //Hàm này trả về số từ trong chuỗi $str.
    //echo str_word_count($str)
    //Hàm này lặp chuỗi $str $n lần.
    //echo str_repeat($str,2)
    //Hàm này tìm kiếm và thay thế chuỗi.
    //echo $newStr = str_replace('.net','.com',$str);
    //echo '<br />';
    //Để thay thế nhiều chuỗi ta có thể dùng mảng để truyền vào
    //echo $newStr = str_replace(['.net','free'],['.com','Fee'],$str);
    //Hàm này mã hóa chuỗi thành một dãy 32 ký tự (mã hóa md5).
    //echo md5($str);
    //echo '<br />';
    //Hàm này mã hóa chuỗi thành một dãy 40 ký tự (mã hóa sha1)
    //echo sha1($str);
    //Hàm này chuyển các thể html trong chuỗi $str sang  dạng thực thể của chúng (html sẽ ko còn tác dụng nên bạn có thể echo ra bên ngoài).
    $str = '<h1> CuongPH </h1>';
    //echo $str;
    //echo $str = htmlentities($str);
    //echo '<br />';
    //Ngược lại với htmlentities, hàm này chuyển ngược các ký tự dạng thực thể HTML sang dạng ký tự của chúng.
    //echo html_entity_decode($str);
    //echo '<br />';
    //Tương tự như htmlentities.
    //echo $str = htmlspecialchars($str);
    echo '<br />';
    //echo htmlspecialchars_decode($str);
    //Hàm này bỏ các thẻ html trong chuỗi $string được khai báo ở $allow_tags.
    //echo $str = strip_tags($str,'h1');
    //Hàm này lấy một chuỗi con nằm trong chuỗi $str bắt đầu từ ký tự thứ $start và chiều dài $length.
    //echo substr($str,1,3);
    //echo '<br />';
    //Tách một chuỗi bắt đầu từ  $ky_tu_cho_truoc cho đến hết chuỗi.
    //echo strstr($str,'ng');
    //Tìm vị trí của chuỗi $chuoi_tim trong chuỗi $str, kết quả trả về false nếu không tìm thấy.
    //echo strpos($str,'n');
    //Chuyển tất cả các ký tự chuỗi $str sang chữ thường
    //echo strtolower('ABC');
    //Chuyển tất cả các ký tự chuỗi $str sang chữ hoa
    //echo strtoupper('abc');
    //Chuyển ký tự đầu tiên chuỗi $string sang chữ hoa
    //echo ucfirst('cuong va hung');
    //ungChuyển ký tự đầu tiên trong chuỗi $string sang chữ thường
    //echo lcfirst('Cuong');
    //Chuyên ký tự đầu tiên của từ trong chuỗi $string sang chữ hoa
    //echo ucwords('cuong va hung');
    //Xóa ký tự $ky_tu nằm ở đầu và cuối chuỗi $str, nếu ta không nhập $ky_tu thì mặc định nó hiểu là xóa khoảng trắng.
    //echo trim('cuong va hungh','h');
    //Tương tự như trim nhưng chỉ xóa bên trái
    //echo ltrim();
    //Tương tự như trim nhưng chỉ xóa bên phải
    //echo rtrim();
    //Chuyển các ký tự xuống dòng “\n” thành thẻ
    //$str = 'abc\n';
   // echo $str;
    //echo nl2br($str);
    //echo bin2hex($str);
    //echo $binarydata = pack("nvc*", 0x1234, 0x5678, 65, 66);
    //$data = "areetuts.net is a website free for you.";
    //foreach (count_chars($data, 1) as $i => $val) {
    //    echo "There were $val instance(s) of " , chr($i) , " in the string.";
    //    echo "<br />";
    //}
    //$str = chr(240) . chr(159) . chr(144) . chr(152);
    //echo $str;
    //Dùng để chuyển chuỗi dạng JSON sang các đối tượng mảng hoặc object. Nếu $is_array có giá trị false thì hàm sẽ chuyển một chuỗi $json thành một Class (object),  ngược lại nếu $is_array có giá trị true thì sẽ chuyển chuỗi $json thành một mảng.
    //Chuyển một mảng hoặc mội đối tượng (classs) sang chuỗi dạng JSON
    //$text = "The quick brown fox jumped over the lazy dog.";
    //$newtext = wordwrap($text, 5, "\t",false);

    //echo $newtext;

$str = 'abcdef';
$shuffled = str_shuffle($str);
echo $shuffled;
@endphp
{{--<h1>{{ $tieude->plaintext }}</h1>--}}
{{--<div id="content">{{ $noidung->innertext }}</div>--}}