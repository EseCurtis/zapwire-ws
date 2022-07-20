<?php
class CreateAvatar {
    static function image()
    {
        $randomImageName = md5(time()).".png";
        $randomAvatar = new randomAvatarsGenerator();
        $randomAvatar->generate();
        $randomAvatar->draw();
        $randomAvatar->saveImage("vault/images/", $randomImageName);

        return "vault/images/".$randomImageName;
    }

    static function delete($imageFilePath)
    {
        unlink($imageFilePath);
    }

    function base64()
    {
        $imageFilePath = $this->image();
        $imageData = base64_encode(file_get_contents($imageFilePath));
        $image = 'data:image/png;base64,'.$imageData;

        
        $this->delete($imageFilePath); 

        return $image;
    }

    function print_to_dom($string)
    {
        $image = $this->base64($string);
        echo '<img src="'.$image.'" />';
    }
}
