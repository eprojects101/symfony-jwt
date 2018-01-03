<?php

namespace AppBundle\Controller;

use DomainBundle\Document\Grouper;
use DomainBundle\Document\Material;
use DomainBundle\Document\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);

    }

    /**
     * @Route("/aws/{filename}")
     * @Method({"GET"})
     */
    public function getAccessToken($filename) {

        $bucket_name = 'media-vendamais.socialbase.com.br';
        $aws_secret_key = '4xJ8RbI7Wl79gOiMZRDDg0pnwTL7xDVM0wDcn9b5';
        $aws_access_key_id = 'AKIAJWG6MD36ZUWZKCFQ';

        $now = time() + (12 * 60 * 60 * 1000);
        $expire = gmdate('Y-m-d\TH:i:s\Z', $now);

        $policy_document = '
            {"expiration": "' . $expire . '",
             "conditions": [
                {"bucket": "' . $bucket_name . '"},
                {"filename": "' . $filename . '"},
                ["starts-with", "$key", ""],
                {"acl": "public-read"},
                ["content-length-range", 0, 10485760],
                ["starts-with", "$Content-Type", ""]
            ]
        }';

        $policy = base64_encode($policy_document);

        $hash = $this->hmacsha1($aws_secret_key, $policy);

        $signature = $this->hex2b64($hash);

        $token = array('policy' => $policy,
            'signature' => $signature,
            'key' => $aws_access_key_id);

        $response = new JsonResponse(json_encode($token));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    private function hmacsha1($key, $data) {
        $blocksize = 64;
        $hashfunc = 'sha1';
        if(strlen($key) > $blocksize)
            $key = pack('H*', $hashfunc($key));
        $key = str_pad($key, $blocksize, chr(0x00));
        $ipad = str_repeat(chr(0x36), $blocksize);
        $opad = str_repeat(chr(0x5c), $blocksize);
        $hmac = pack('H*', $hashfunc(($key ^ $opad).pack('H*', $hashfunc(($key ^ $ipad).$data))));
        return bin2hex($hmac);
    }

    private function hex2b64($str) {
        $raw = '';
        for($i=0; $i < strlen($str); $i+=2) {
            $raw .= chr(hexdec(substr($str, $i, 2)));
        }
        return base64_encode($raw);
    }

}
