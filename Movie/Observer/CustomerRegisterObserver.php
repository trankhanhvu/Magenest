<?php
namespace Magenest\Movie\Observer;

use Magenest\Movie\Block\PHPMailer;
use Magento\Framework\Event\ObserverInterface;


class CustomerRegisterObserver implements ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $customer = $observer->getCustomer();

        $email = $customer->getEmail();
        $firstname = $customer->getFirstname();
        $lastname = $customer->getLastname();

        $mail = new PHPMailer();

        $mail->addTo('boykunis95@gmail.com');

        $mail->Subject('Welcome!!!');

        $html='<h2>Hello' . $lastname . ' ' . $firstname . ' ' . $email . '</h2>';
        $html =$html . '<h3>Welcome to our website !!!</h3>' ;
/*        $html = file_get_contents('/var/www/html/m2/app/code/Magenest/Movie/view/adminhtml/templates/aboutinfo.phtml');*/

        $mail->Body($html);

        $mail->Send();
    }
}