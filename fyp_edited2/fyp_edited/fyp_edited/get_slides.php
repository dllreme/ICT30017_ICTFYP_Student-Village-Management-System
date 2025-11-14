<?php
// get_slides.php
class SliderManager {
    private $dataFile = 'slider_data.json';
    
    public function __construct() {
        if (!file_exists($this->dataFile)) {
            file_put_contents($this->dataFile, json_encode([]));
        }
    }
    
    public function getActiveSlides() {
        if (!file_exists($this->dataFile)) {
            return [];
        }
        $json = file_get_contents($this->dataFile);
        $data = json_decode($json, true) ?: [];
        
        // Filter only active slides and sort by display order
        $activeSlides = array_filter($data, function($slide) {
            return $slide['is_active'];
        });
        
        // Sort by display_order
        usort($activeSlides, function($a, $b) {
            return $a['display_order'] - $b['display_order'];
        });
        
        return $activeSlides;
    }
}

$sliderManager = new SliderManager();
$slides = $sliderManager->getActiveSlides();

header('Content-Type: application/json');
echo json_encode($slides);
?>