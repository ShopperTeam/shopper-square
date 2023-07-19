<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixtures extends Fixture
{
    protected $faker;

    public function load(ObjectManager $manager): void
    {
        $this->faker = Factory::create();
        $this->loadProducts($manager);
    }

    private function loadProducts(ObjectManager $manager): void
    {
        $i = 1;
        foreach ($this->getProductData() as [$photo]) {
            $product = new Product();

            $productName = $this->faker->text($maxNbChars = 20);
            $product->setName($productName);
            $product->setDescription($this->faker->paragraph($nbSentences = 5, $variableNbSentences = true));
            $product->setPrice($this->faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 500));
            $product->setPhoto($photo);
            $this->addReference('product_'.$i, $product);

            $manager->persist($product);
            $i++;
        }

        $manager->flush();
    }


    private function getProductData(): array
    {
        return [
            // $userData = [$photo];
            ['https://www.cdiscount.com/pdt2/8/5/2/1/700x700/int3701036803852/rw/kit-upgrade-evolution-pc-12eme-generation-carte.jpg'],
            ['https://www.cdiscount.com/pdt2/8/9/5/1/550x550/cik9440423921895/rw/cikonielf-graphiques-de-jeu-de-1-go-hd7670-carte-v.jpg'],
            ['https://www.cdiscount.com/pdt2/6/2/3/1/700x700/asu4712900459623/rw/asus-carte-graphique-turbo-gtx1070-nvidia-gefo.jpg'],
            ['https://www.cdiscount.com/pdt2/5/3/0/1/700x700/cor0840006608530/rw/memoire-ram-corsair-vengeance-lpx-ddr4-16gb.jpg'],
            ['https://www.cdiscount.com/pdt2/5/5/1/1/700x700/cre5390660190551/rw/creative-sound-blasterx-g1-carte-son-24-bits.jpg'],
            ['https://www.cdiscount.com/pdt2/5/1/7/1/700x700/auc0608819212517/rw/carte-son-usb-.jpg'],
            ['https://www.cdiscount.com/pdt2/7/4/1/1/700x700/auc0726111673741/rw/boitier-de-disque-dur-mobile-sata-2-5-pouces-cou.jpg'],
            ['https://www.cdiscount.com/pdt2/5/4/6/1/700x700/auc4719331809546/rw/carte-mere-gigabyte-technology-b550m-aorus-eli.jpg'],
            ['https://www.cdiscount.com/pdt2/5/9/7/1/700x700/auc7786629862597/rw/dvb-t2-t-dvb-c-tv-tuner-stick-usb-2-0-dongle-pc-la.jpg'],
            ['https://www.cdiscount.com/pdt2/5/7/3/1/550x550/one0191461001573/rw/graveur-lecteur-de-dvd-externe-usb-3-0-haute-vites.jpg'],
            ['https://www.cdiscount.com/pdt2/9/5/3/1/550x550/auc8432290261953/rw/carte-reseau-wi-fi-avec-bluetooth-4-2-adaptateur-p.jpg'],
            ['https://www.cdiscount.com/pdt2/5/0/4/1/700x700/auc0748018094504/rw/carte-reseau-double-bande-2-4g-5g-bluetooth-4.jpg'],
            ['https://www.cdiscount.com/pdt2/6/9/7/1/550x550/emp3701281101697/rw/empire-gaming-boitier-pc-gamer-darkwitcher-argb-m.jpg'],
            ['https://www.cdiscount.com/pdt2/0/7/3/1/550x550/buz0786552012073/rw/support-adaptateur-caddy-disque-dur-en-alliage-d-a.jpg'],
            ['https://www.cdiscount.com/pdt2/3/0/1/1/550x550/auc3455669965301/rw/ajw-2-x-tze-re34-tz-re34-or-sur-rose-cassette-de-r.jpg'],
            ['https://www.cdiscount.com/pdt2/3/2/6/1/700x700/auc3094828793326/rw/lot-de-2-cartouches-de-ruban-adhesif-lamine-tze-tz.jpg'],
            ['https://www.cdiscount.com/pdt2/1/7/9/1/700x700/kin6950509900179/rw/kingspec-disque-ssd-interne-nt-series-1-to.jpg'],
            ['https://www.cdiscount.com/pdt2/5/5/3/1/700x700/cru0649528821553/rw/crucial-disque-ssd-interne-bx500-1to-2-5.jpg'],
            ['https://www.cdiscount.com/pdt2/4/6/4/1/700x700/cod0192511463464/rw/2-5-pouces-ssd-a-3-5-pouces-support-de-kit-de-mont.jpg'],
            ['https://www.cdiscount.com/pdt2/1/4/6/1/700x700/tec5823049154146/rw/td-r-disque-dur-externe-sata-usb-3-0-boitier-2-5i.jpg'],
            ['https://www.cdiscount.com/pdt2/2/6/7/1/550x550/hom0736232994267/rw/4-baies-2-5-pouces-a-3-5-pouces-ssd-hdd-support-de.jpg'],
            ['https://www.cdiscount.com/pdt2/4/1/6/1/550x550/omn4026397325416/rw/rack-19-pouces-10-uh-omnitronic-sr-19-acier.jpg'],
            ['https://www.cdiscount.com/pdt2/6/7/2/1/700x700/ras3272496299672/rw/boitier-ventile-pour-raspberry-pi-4-gris.jpg'],
            ['https://www.cdiscount.com/pdt2/9/1/9/1/700x700/asu4712900093919/rw/asus-lecteur-dvd-rw-drw-24d5mt-blk-g-as-90dd01y.jpg'],
            ['https://www.cdiscount.com/pdt2/3/2/2/1/700x700/vib5057551885322/rw/vibox-vi-4-pc-gamer-24-ecran-pack-amd-athlon.jpg'],
        ];
    }


}



