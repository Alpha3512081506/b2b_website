<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Imaggine;
use App\Entity\Prodotto;
use App\Entity\Categoria;
use App\Entity\Purchase;
use App\Entity\PurchaseItem;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use  Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\X509Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $sluggerInterface;
    private $userPasswordEncoderInterface;
    public function __construct(SluggerInterface $sluggerInterface, UserPasswordEncoderInterface $userPasswordEncoderInterface)
    {
        $this->sluggerInterface = $sluggerInterface;
        $this->userPasswordEncoderInterface = $userPasswordEncoderInterface;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('it_IT');
        $faker->addProvider(new \Liior\Faker\Prices($faker));
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
        $faker->addProvider(new \Bezhanov\Faker\Provider\Device($faker));
        $faker->addProvider(new \Mmo\Faker\PicsumProvider($faker));
        $genres = ['male', 'female'];
        $genre = $faker->randomElement($genres);
        $picture = 'https://randomuser.me/api/portraits/';
        $pictureId = $faker->numberBetween(1, 99) . '..jpg';
        if ($genre == 'male') {
            $picture = $picture . 'men/' . $pictureId;
        } else {
            $picture = $picture . 'women/' . $pictureId;
        }
        $admin = new User;
        $hash = $this->userPasswordEncoderInterface->encodePassword($admin, "Admin123");
        $admin->setEmail("admin@gmail.com")
            ->setFirstName($faker->firstName())
            ->setLastName($faker->lastName)
            ->setPartitaIva($faker->creditCardNumber)
            ->setRagioneSociale($faker->jobTitle)
            ->setReferente($faker->titleMale)
            ->setTelefono($faker->phoneNumber)
            ->setVia($faker->streetAddress)
            ->setCap($faker->postcode)
            ->setCitta($faker->city)
            ->setCodiceUnivoco($faker->md5)
            ->setPassword($hash)
            ->setRoles(["ROLE_ADMIN"])
            ->setAvatar('https://randomuser.me/api/portraits/men/80.jpg');
        $manager->persist($admin);
        $users = [];
        for ($u = 0; $u < 5; $u++) {
            $user = new User;
            $hash = $this->userPasswordEncoderInterface->encodePassword($user, "secret");
            $user->setEmail("user$u@gmail.com")
                ->setFirstName($faker->firstName())
                ->setLastName($faker->lastName)
                ->setPartitaIva($faker->creditCardNumber)
                ->setRagioneSociale($faker->jobTitle)
                ->setReferente($faker->titleMale)
                ->setTelefono($faker->phoneNumber)
                ->setVia($faker->streetAddress)
                ->setCap($faker->postcode)
                ->setCitta($faker->city)
                ->setCodiceUnivoco($faker->md5)

                ->setPassword($hash)
                ->setAvatar($picture);
            $users[] = $user;
            $manager->persist($user);
        }
        for ($c = 0; $c < 5; $c++) {
            $categoria = new Categoria;
            $categoria->setNomeCategoria($faker->department);
            //->setSlug(strtolower($this->sluggerInterface->slug($categoria->getNomeCategoria())));
            $manager->persist($categoria);
            $products = [];
            for ($i = 0; $i < mt_rand(15, 20); $i++) {
                $product = new Prodotto();
                $product->setColore($faker->colorName)
                    ->setCommento($faker->text())
                    ->setDimensioniRAM("8Gb")
                    ->setCoverImage($faker->picsumUrl())
                    ->setDimensioniSchermo(mt_rand(12, 22) . " pollici")
                    ->setMarca($faker->deviceManufacturer)

                    ->setModelloCPU($faker->promotionCode)
                    ->setNomeStile($faker->productName)
                    ->setPrezzo($faker->price(4000, 20000))
                    // ->setSlug(strtolower($this->sluggerInterface->slug($product->getNomeStile())))
                    ->setCategoria($categoria);
                $products[] = $product;

                /*  for ($j = 0; $j < mt_rand(3, 5); $j++) {
                    $imaggine = new Imaggine;
                    $imaggine->setLinkImaggine($faker->imageUrl())
                        ->setCaption($faker->word())
                        ->setProdutto($product);
                    $manager->persist($imaggine);
                } */
                $manager->persist($product);
            }
            for ($p = 0; $p < mt_rand(10, 30); $p++) {
                $purchase = new Purchase;
                $purchase->setAddress($faker->streetAddress)
                    ->setFullName($faker->name)
                    ->setRagioneSociale($faker->domainWord)
                    ->setVia($faker->streetAddress)
                    ->setCity($faker->city)
                    ->setPostalCode($faker->postcode)
                    ->setTelefono($faker->phoneNumber)
                    ->setEmail($faker->email)
                    ->setUser($faker->randomElement($users))
                    // ->setTotal(mt_rand(2000, 30000))
                    ->setPurchaseAt($faker->dateTimeBetween('-6 months'));
                if ($faker->boolean(90)) {
                    $purchase->setStatus(Purchase::STATUS_PAID);
                }
                $selectedProducts = $faker->randomElements($products, mt_rand(3, 5));
                foreach ($selectedProducts as $product) {
                    $purchaseItem = new PurchaseItem;
                    $purchaseItem->setProduct($product)
                        ->setProductName($product->getNomeStile())
                        ->setQuantity(mt_rand(1, 3))
                        ->setProductPrice($product->getPrezzo())
                        ->setTotal(
                            $purchaseItem->getProductPrice() * $purchaseItem->getQuantity()
                        )
                        ->setPurchase($purchase);
                    $manager->persist($purchaseItem);
                }
                $manager->persist($purchase);
            }
        }




        $manager->flush();
    }
}
