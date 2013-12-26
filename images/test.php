<?php
ob_start();

// echo '<pre>';

// Get height of all images
$images = array ();
$totalHeight = 0;
foreach (glob("/Users/jw/picturesss/*.JPG") as $jpg)
{
    $img = imagecreatefromjpeg($jpg);
    $images[$jpg] = imagesy($img);
    $totalHeight += $images[$jpg];
    imagedestroy($img);
}

// echo "image list with heights:\n";
// var_dump($images);

// Shuffle image array of files preserving keys to get random image disposition
$keys = array_keys($images);
shuffle($keys);
$images = array_merge(array_flip($keys), $images);

// Separate image names and heights, will simplify our future work
$heights = array_values($images);
$images = array_keys($images);

// echo "image list:\n";
// var_dump($images);

// echo "total heights: {$totalHeight}\n";

// echo "image heights:\n";
// var_dump($heights);

// Get percentage of image height compared to the total height
$count = count($heights);
for ($i = 0; ($i < $count); $i++)
{
    $heights[$i] = ($heights[$i] * 100) / $totalHeight; // becomes virtual height in a x100 grid
}

// echo "image heights in percents\n";
// var_dump($heights);
// echo "check : " . array_sum($heights) . " = 100\n";

// Get random number of images per line and number of lines
// Between 1 to 4 images/line until there is no more image.
$lines = array ();
while ($count > 0)
{
    $nbImages = rand() % 4 + 1;
    if (($count - $nbImages) < 0)
    {
        $nbImages = $count;
    }

    $lines[] = $nbImages;
    $count -= $nbImages;
}

// echo "Number of lines : " . count($lines) . "\n";
// echo "images per line disposition :\n";
// var_dump($lines);

// Associate an image with a line
$imageLines = array();
foreach ($lines as $key => $numberImg)
{
    while ($numberImg--)
    {
        $imageLines[] = $key;
    }
}

// echo "image / line association:\n";
// var_dump($imageLines);

// Associate an image with a position in a line
$imagePositions = array();
foreach ($lines as $numberImg)
{
    for ($i = 0; ($i < $numberImg); $i++)
    {
        $imagePositions[] = $i;
    }
}

// echo "image / position in a line association:\n";
// var_dump($imagePositions);

// We have from 1 to 4 images/line so we create a grid with a virtual width of 1*2*3*4.
// In this case, 1 image/line = 24, 2/line =24/2=12, 3/line=24/3=8, all are valid integers.
$i = 4;
$virtualWidth = 1;
while ($i)
{
    $virtualWidth *= $i--;
}

// echo "virtual width: {$virtualWidth}\n";

// Determine the virtual height needed for each line and for the whole grid
$imageHeights = array();
$index = 0;
foreach ($lines as $key => $numberImages)
{
    $slice = array_slice($heights, $index, $numberImages);

    // echo "at line {$key}, images heights are:\n";
    // var_dump($slice);

    $imageHeights[] = max($slice);
    $index += $numberImages;
}
$virtualHeight = array_sum($imageHeights);

// echo "heights for each line:\n";
// var_dump($imageHeights);
// echo "total height = {$virtualHeight}\n";



// Create a grid and place logically all images in the virtual area
$imageGrid = new imageGrid(800, 800, $virtualWidth, $virtualHeight);
foreach (glob("/Users/jw/picturesss/*.JPG") as $jpg)
{
    $img = imagecreatefromjpeg($jpg);

    // Determine position
    $index = array_search($jpg, $images);
    // echo "image {$index}:\n";

    $line = $imageLines[$index];
    // echo "image is at line {$line}\n";

    $sizeW = ($virtualWidth / $lines[$line]);
    // echo "width = {$virtualWidth} / {$lines[$line]} = {$sizeW}\n";

    $sizeH = $imageHeights[$line];
    // echo "height = {$imageHeights[$line]}\n";

    $posX = $imagePositions[$index] * ($virtualWidth / $lines[$line]);
    // echo "pos X = {$imagePositions[$index]} * ({$virtualWidth} / {$lines[$line]}) = {$posX}\n";

    $slice = array_slice($imageHeights, 0, $line);
    // echo "Slice to calc Y:\n";
    // var_dump($slice);

    $posY = array_sum($slice);
    // echo "pos Y = {$posY}\n";

    // echo "\n";

    $imageGrid->putImage($img, $sizeW, $sizeH, $posX, $posY);
    imagedestroy($img);
}


ob_end_clean();
$imageGrid->display();


class imageGrid
{

    private $realWidth;
    private $realHeight;
    private $gridWidth;
    private $gridHeight;
    private $image;

    public function __construct($realWidth, $realHeight, $gridWidth, $gridHeight)
    {
        $this->realWidth = $realWidth;
        $this->realHeight = $realHeight;
        $this->gridWidth = $gridWidth;
        $this->gridHeight = $gridHeight;

        // create destination image
        $this->image = imagecreatetruecolor($realWidth, $realHeight);
        $black = imagecolorallocate($this->image, 0, 0, 0);
        imagecolortransparent($this->image, $black);
    }

    public function __destruct()
    {
        imagedestroy($this->image);
    }

    public function display()
    {
        header("Content-type: image/png");
        imagepng($this->image);
    }

    public function putImage($img, $sizeW, $sizeH, $posX, $posY)
    {
        // Cell width
        $cellWidth = $this->realWidth / $this->gridWidth;
        $cellHeight = $this->realHeight / $this->gridHeight;

        // Conversion of our virtual sizes/positions to real ones
        $realSizeW = ceil($cellWidth * $sizeW);
        $realSizeH = ceil($cellHeight * $sizeH);
        $realPosX = ($cellWidth * $posX);
        $realPosY = ($cellHeight * $posY);

        $img = $this->resizePreservingAspectRatio($img, $realSizeW, $realSizeH);

        // Copying the image
        imagecopyresampled($this->image, $img, $realPosX, $realPosY, 0, 0, $realSizeW, $realSizeH, imagesx($img), imagesy($img));
    }

    public function resizePreservingAspectRatio($img, $targetWidth, $targetHeight)
    {
        $srcWidth = imagesx($img);
        $srcHeight = imagesy($img);

        $srcRatio = $srcWidth / $srcHeight;
        $targetRatio = $targetWidth / $targetHeight;
        if (($srcWidth <= $targetWidth) && ($srcHeight <= $targetHeight))
        {
            $imgTargetWidth = $srcWidth;
            $imgTargetHeight = $srcHeight;
        }
        else if ($targetRatio > $srcRatio)
        {
            $imgTargetWidth = (int) ($targetHeight * $srcRatio);
            $imgTargetHeight = $targetHeight;
        }
        else
        {
            $imgTargetWidth = $targetWidth;
            $imgTargetHeight = (int) ($targetWidth / $srcRatio);
        }

        $targetImg = imagecreatetruecolor($targetWidth, $targetHeight);

        imagecopyresampled(
           $targetImg,
           $img,
           ($targetWidth - $imgTargetWidth) / 2, // centered
           ($targetHeight - $imgTargetHeight) / 2, // centered
           0,
           0,
           $imgTargetWidth,
           $imgTargetHeight,
           $srcWidth,
           $srcHeight
        );

        return $targetImg;
    }

}

?>