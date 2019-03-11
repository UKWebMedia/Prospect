<?php

namespace Versionable\Prospect\Response;

use Versionable\Prospect\Header\Collection as HeaderCollection;
use Versionable\Prospect\Cookie\Collection as CookieCollection;

use Versionable\Prospect\Header\CollectionInterface as HeaderCollectionInterface;
use Versionable\Prospect\Cookie\CollectionInterface as CookieCollectionInterface;

class Response implements ResponseInterface
{

  /*
   * @var integer HTTP Response code
   */
  protected $code = null;

  /**
   *
   * @var string Response body
   */
  protected $content = '';

  /**
   *
   * @var \Versionable\Prospect\Header\Collection
   */
  protected $headers = null;

  /**
   *
   * @var \Versionable\Prospect\Cookie\Collection
   */
  protected $cookies = null;

  public function parse($responseString)
  {
    list($code, $headers, $cookies,  $content) = $this->parseResponse($responseString);

    $this->setCode($code);
    $this->setHeaders($headers);
    $this->setCookies($cookies);
    $this->setContent($content);
  }

  public function getCode()
  {
    return $this->code;
  }

  public function setCode($code)
  {
    if (array_key_exists($code, \Symfony\Component\HttpFoundation\Response::$statusTexts)) {
      $this->code = $code;
    } else {
      throw new \InvalidArgumentException('Unknown HTTP code: ' . $code, $code);
    }
  }

  public function getContent()
  {
    return $this->content;
  }

  public function setContent($content)
  {
    $this->content = $content;
  }

  public function getHeaders()
  {
    return $this->headers;
  }

  public function setHeaders(HeaderCollectionInterface $headers)
  {
    $this->headers = $headers;
  }

  public function getCookies()
  {
    return $this->cookies;
  }

  public function setCookies(CookieCollectionInterface $cookies)
  {
    $this->cookies = $cookies;
  }

  protected function parseResponse($response)
  {

    // cURL automatically handles Proxy rewrites, remove the "HTTP/1.0 200 Connection established" string
    if (false !== stripos($response, "HTTP/1.0 200 Connection established\r\n\r\n")) {
        $response = str_ireplace("HTTP/1.0 200 Connection established\r\n\r\n", '', $response);
    }

    list($response_headers,$body) = explode("\r\n\r\n",$response,2);

    $header_lines = explode("\r\n",$response_headers);

    // first line of headers is the HTTP response code
    $http_response_line = array_shift($header_lines);

    $code = null;
    if (preg_match('@^HTTP/[0-9]\.[0-9] ([0-9]{3})@',$http_response_line, $matches)) {
      $code = $matches[1];
    }

    $cookies = new CookieCollection();
    $headers = new HeaderCollection();
    foreach ($header_lines as $line) {
      list($name, $value) = explode(': ', $line);

      if ($name == 'Set-Cookie') {
        $cookies->parse($value);
      } else {
        $headers->parse($name, $value);
      }
    }

    return array($code, $headers, $cookies,  $body);
  }

}
