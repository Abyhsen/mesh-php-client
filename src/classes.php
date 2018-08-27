<?php

namespace GenticsMeshRestApi\Raml;

use GuzzleHttp\Psr7\Request as HttpRequest;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7;
use Psr\Http\Message\RequestInterface;

class Resource {
    const TEMPLATE_REGEXP = '/\{([^\{\}]+)\}/';

    /**
     * @param   $string
     * @param  mixed $interpolate
     * @param  mixed $defaults
     * @return string
     */
    final protected function template($string, array $interpolate = [], array $defaults = []) {
        return (string)preg_replace_callback(static::TEMPLATE_REGEXP, function ($matches) use ($defaults, $interpolate) {
            $key = $matches[1];
            if (isset($interpolate[$key]) && $interpolate[$key] != null) {
                return urlencode((string)$interpolate[$key]);
            }

            if (isset($defaults[$key]) && $defaults[$key] != null) {
                return urlencode((string)$defaults[$key]);
            }

            return '';
        }, $string);
    }

    private $uri;

    public function __construct($uri) {
        $this->uri = $uri;
    }

    /**
     * @return string
     */
    final protected function getUri() {
        return $this->uri;
    }

    /**
     * @param $method
     * @param $uri
     * @param mixed $body
     * @param array $options
     * @return RequestInterface
     */
    final protected function buildRequest( $method,  $uri, $body = null, array $options = [], $requestClass = 'Request')
    {
        $headers = isset($options['headers']) ? $options['headers'] : [];
        $requestClass = '\\GenticsMeshRestApi\\Raml\\' . $requestClass;
        /**
         * @var RequestInterface $request
         */
        $request = new $requestClass($method, $uri, $headers, $body);

        if (isset($options['query'])) {
            ksort($options['query']);
            $uri = $request->getUri()->withQuery(Psr7\build_query($options['query']));
            $request = $request->withUri($uri);
        }
        

        return $request;
    }
}

class Request extends HttpRequest
{
}

class RequestBuilder extends Resource
{
    public function __construct($options = [])
    {
        $baseUriParameters = [];
        if (isset($options['baseUriParameters'])) {
            $baseUriParameters = $options['baseUriParameters'];
        }
        if (isset($options['baseUri'])) {
            $baseUri = $this->template($options['baseUri'], $baseUriParameters);
        } else {
            $baseUri = $this->template('http://localhost:8080/api/v1', []);
        }
        parent::__construct(trim($baseUri, '/'));
    }
    
    /**
     * @return RequestInterface
     */
    final public function buildCustom( $method,  $uri, $body = null, array $options = [])
    {
        if (isset($options['uriParameters'])) {
            $uri = $this->template($this->getUri() . $uri, $options['uriParameters']);
            unset($options['uriParams']);
        } else {
            $uri = $this->getUri() . $uri;
        }
        return $this->buildRequest($method, $uri, $body, $options);
    }


    /**
     * @return Resource1
     */
    public function rawSearch() {
        return new Resource1($this->getUri() . '/rawSearch');
    }

    /**
     * @return Resource56
     */
    public function users() {
        return new Resource56($this->getUri() . '/users');
    }

    /**
     * @return Resource62
     */
    public function roles() {
        return new Resource62($this->getUri() . '/roles');
    }

    /**
     * @return Resource66
     */
    public function utilities() {
        return new Resource66($this->getUri() . '/utilities');
    }

    /**
     * @return Resource70
     */
    public function groups() {
        return new Resource70($this->getUri() . '/groups');
    }

    /**
     * @return Resource76
     */
    public function auth() {
        return new Resource76($this->getUri() . '/auth');
    }

    /**
     * @return Resource80
     */
    public function projects() {
        return new Resource80($this->getUri() . '/projects');
    }

    /**
     * @return Resource82
     */
    public function schemas() {
        return new Resource82($this->getUri() . '/schemas');
    }

    /**
     * @return Resource86
     */
    public function microschemas() {
        return new Resource86($this->getUri() . '/microschemas');
    }

    /**
     * @return Resource90
     */
    public function admin() {
        return new Resource90($this->getUri() . '/admin');
    }

    /**
     * @return Resource106
     */
    public function search() {
        return new Resource106($this->getUri() . '/search');
    }

    /**
     * @return Resource11
     */
    public function withProject ($project) {
      
        $uri = $this->template($this->getUri() . '/{project}', ['project' => $project]);
        return new Resource11($uri);
    }

}
final class Resource1 extends Resource {

    /**
     * @return Resource2
     */
    public function nodes() {
        return new Resource2($this->getUri() . '/nodes');
    }

    /**
     * @return Resource3
     */
    public function projects() {
        return new Resource3($this->getUri() . '/projects');
    }

    /**
     * @return Resource4
     */
    public function roles() {
        return new Resource4($this->getUri() . '/roles');
    }

    /**
     * @return Resource5
     */
    public function schemas() {
        return new Resource5($this->getUri() . '/schemas');
    }

    /**
     * @return Resource6
     */
    public function tagFamilies() {
        return new Resource6($this->getUri() . '/tagFamilies');
    }

    /**
     * @return Resource7
     */
    public function tags() {
        return new Resource7($this->getUri() . '/tags');
    }

    /**
     * @return Resource8
     */
    public function users() {
        return new Resource8($this->getUri() . '/users');
    }

    /**
     * @return Resource9
     */
    public function microschemas() {
        return new Resource9($this->getUri() . '/microschemas');
    }

    /**
     * @return Resource10
     */
    public function groups() {
        return new Resource10($this->getUri() . '/groups');
    }
}
final class Resource2 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource3 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource4 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource5 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource6 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource7 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource8 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource9 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource10 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource11 extends Resource {

    /**
     * @return Resource12
     */
    public function microschemas() {
        return new Resource12($this->getUri() . '/microschemas');
    }

    /**
     * @return Resource14
     */
    public function nodes() {
        return new Resource14($this->getUri() . '/nodes');
    }

    /**
     * @return Resource30
     */
    public function tagFamilies() {
        return new Resource30($this->getUri() . '/tagFamilies');
    }

    /**
     * @return Resource35
     */
    public function navroot() {
        return new Resource35($this->getUri() . '/navroot');
    }

    /**
     * @return Resource37
     */
    public function webroot() {
        return new Resource37($this->getUri() . '/webroot');
    }

    /**
     * @return Resource39
     */
    public function releases() {
        return new Resource39($this->getUri() . '/releases');
    }

    /**
     * @return Resource45
     */
    public function graphql() {
        return new Resource45($this->getUri() . '/graphql');
    }

    /**
     * @return Resource46
     */
    public function search() {
        return new Resource46($this->getUri() . '/search');
    }

    /**
     * @return Resource50
     */
    public function rawSearch() {
        return new Resource50($this->getUri() . '/rawSearch');
    }

    /**
     * @return Resource54
     */
    public function schemas() {
        return new Resource54($this->getUri() . '/schemas');
    }
}
final class Resource12 extends Resource {

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }

    /**
     * @return Resource13
     */
    public function withMicroschemaUuid ($microschemaUuid) {
      
        $uri = $this->template($this->getUri() . '/{microschemaUuid}', ['microschemaUuid' => $microschemaUuid]);
        return new Resource13($uri);
    }
}
final class Resource13 extends Resource {

    /**
     * @return RequestInterface
     */
    public function delete ($body = null, array $options = []) {

        return $this->buildRequest('delete', $this->getUri(), $body, $options);
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource14 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return Resource14GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource14GetRequest');
    }

    /**
     * @return Resource15
     */
    public function withNodeUuid ($nodeUuid) {
      
        $uri = $this->template($this->getUri() . '/{nodeUuid}', ['nodeUuid' => $nodeUuid]);
        return new Resource15($uri);
    }
}
final class Resource14GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource14GetRequest
     */
    public function withRole($role) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['role']) && !is_array($this->queryParts['role'])) {
            $this->queryParts['role'] = [$this->queryParts['role']];
        }
        $this->queryParts['role'][] = $role;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource14GetRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource14GetRequest
     */
    public function withResolveLinks($resolveLinks) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['resolveLinks']) && !is_array($this->queryParts['resolveLinks'])) {
            $this->queryParts['resolveLinks'] = [$this->queryParts['resolveLinks']];
        }
        $this->queryParts['resolveLinks'][] = $resolveLinks;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource14GetRequest
     */
    public function withRelease($release) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['release']) && !is_array($this->queryParts['release'])) {
            $this->queryParts['release'] = [$this->queryParts['release']];
        }
        $this->queryParts['release'][] = $release;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource14GetRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource14GetRequest
     */
    public function withLang($lang) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['lang']) && !is_array($this->queryParts['lang'])) {
            $this->queryParts['lang'] = [$this->queryParts['lang']];
        }
        $this->queryParts['lang'][] = $lang;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource14GetRequest
     */
    public function withVersion($version) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['version']) && !is_array($this->queryParts['version'])) {
            $this->queryParts['version'] = [$this->queryParts['version']];
        }
        $this->queryParts['version'][] = $version;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource15 extends Resource {

    /**
     * @return Resource16
     */
    public function binary() {
        return new Resource16($this->getUri() . '/binary');
    }

    /**
     * @return Resource18
     */
    public function binaryTransform() {
        return new Resource18($this->getUri() . '/binaryTransform');
    }

    /**
     * @return Resource20
     */
    public function children() {
        return new Resource20($this->getUri() . '/children');
    }

    /**
     * @return Resource21
     */
    public function languages() {
        return new Resource21($this->getUri() . '/languages');
    }

    /**
     * @return Resource24
     */
    public function moveTo() {
        return new Resource24($this->getUri() . '/moveTo');
    }

    /**
     * @return Resource26
     */
    public function navigation() {
        return new Resource26($this->getUri() . '/navigation');
    }

    /**
     * @return Resource27
     */
    public function published() {
        return new Resource27($this->getUri() . '/published');
    }

    /**
     * @return Resource28
     */
    public function tags() {
        return new Resource28($this->getUri() . '/tags');
    }

    /**
     * @return Resource15GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource15GetRequest');
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return Resource15DeleteRequest
     */
    public function delete ($body = null, array $options = []) {

        return $this->buildRequest('delete', $this->getUri(), $body, $options, 'Resource15DeleteRequest');
    }
}
final class Resource15GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource15GetRequest
     */
    public function withRole($role) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['role']) && !is_array($this->queryParts['role'])) {
            $this->queryParts['role'] = [$this->queryParts['role']];
        }
        $this->queryParts['role'][] = $role;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource15GetRequest
     */
    public function withLang($lang) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['lang']) && !is_array($this->queryParts['lang'])) {
            $this->queryParts['lang'] = [$this->queryParts['lang']];
        }
        $this->queryParts['lang'][] = $lang;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource15GetRequest
     */
    public function withVersion($version) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['version']) && !is_array($this->queryParts['version'])) {
            $this->queryParts['version'] = [$this->queryParts['version']];
        }
        $this->queryParts['version'][] = $version;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource15GetRequest
     */
    public function withResolveLinks($resolveLinks) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['resolveLinks']) && !is_array($this->queryParts['resolveLinks'])) {
            $this->queryParts['resolveLinks'] = [$this->queryParts['resolveLinks']];
        }
        $this->queryParts['resolveLinks'][] = $resolveLinks;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource15GetRequest
     */
    public function withRelease($release) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['release']) && !is_array($this->queryParts['release'])) {
            $this->queryParts['release'] = [$this->queryParts['release']];
        }
        $this->queryParts['release'][] = $release;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource15DeleteRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource15DeleteRequest
     */
    public function withRecursive($recursive) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['recursive']) && !is_array($this->queryParts['recursive'])) {
            $this->queryParts['recursive'] = [$this->queryParts['recursive']];
        }
        $this->queryParts['recursive'][] = $recursive;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource16 extends Resource {

    /**
     * @return Resource17
     */
    public function withFieldName ($fieldName) {
      
        $uri = $this->template($this->getUri() . '/{fieldName}', ['fieldName' => $fieldName]);
        return new Resource17($uri);
    }
}
final class Resource17 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return Resource17GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource17GetRequest');
    }
}
final class Resource17GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource17GetRequest
     */
    public function withFpz($fpz) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['fpz']) && !is_array($this->queryParts['fpz'])) {
            $this->queryParts['fpz'] = [$this->queryParts['fpz']];
        }
        $this->queryParts['fpz'][] = $fpz;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource17GetRequest
     */
    public function withRect($rect) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['rect']) && !is_array($this->queryParts['rect'])) {
            $this->queryParts['rect'] = [$this->queryParts['rect']];
        }
        $this->queryParts['rect'][] = $rect;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource17GetRequest
     */
    public function withRelease($release) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['release']) && !is_array($this->queryParts['release'])) {
            $this->queryParts['release'] = [$this->queryParts['release']];
        }
        $this->queryParts['release'][] = $release;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource17GetRequest
     */
    public function withW($w) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['w']) && !is_array($this->queryParts['w'])) {
            $this->queryParts['w'] = [$this->queryParts['w']];
        }
        $this->queryParts['w'][] = $w;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource17GetRequest
     */
    public function withH($h) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['h']) && !is_array($this->queryParts['h'])) {
            $this->queryParts['h'] = [$this->queryParts['h']];
        }
        $this->queryParts['h'][] = $h;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource17GetRequest
     */
    public function withVersion($version) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['version']) && !is_array($this->queryParts['version'])) {
            $this->queryParts['version'] = [$this->queryParts['version']];
        }
        $this->queryParts['version'][] = $version;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource17GetRequest
     */
    public function withFpy($fpy) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['fpy']) && !is_array($this->queryParts['fpy'])) {
            $this->queryParts['fpy'] = [$this->queryParts['fpy']];
        }
        $this->queryParts['fpy'][] = $fpy;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource17GetRequest
     */
    public function withCrop($crop) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['crop']) && !is_array($this->queryParts['crop'])) {
            $this->queryParts['crop'] = [$this->queryParts['crop']];
        }
        $this->queryParts['crop'][] = $crop;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource17GetRequest
     */
    public function withFpx($fpx) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['fpx']) && !is_array($this->queryParts['fpx'])) {
            $this->queryParts['fpx'] = [$this->queryParts['fpx']];
        }
        $this->queryParts['fpx'][] = $fpx;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource18 extends Resource {

    /**
     * @return Resource19
     */
    public function withFieldName ($fieldName) {
      
        $uri = $this->template($this->getUri() . '/{fieldName}', ['fieldName' => $fieldName]);
        return new Resource19($uri);
    }
}
final class Resource19 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource20 extends Resource {

    /**
     * @return Resource20GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource20GetRequest');
    }
}
final class Resource20GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource20GetRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource20GetRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource20GetRequest
     */
    public function withLang($lang) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['lang']) && !is_array($this->queryParts['lang'])) {
            $this->queryParts['lang'] = [$this->queryParts['lang']];
        }
        $this->queryParts['lang'][] = $lang;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource20GetRequest
     */
    public function withResolveLinks($resolveLinks) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['resolveLinks']) && !is_array($this->queryParts['resolveLinks'])) {
            $this->queryParts['resolveLinks'] = [$this->queryParts['resolveLinks']];
        }
        $this->queryParts['resolveLinks'][] = $resolveLinks;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource20GetRequest
     */
    public function withVersion($version) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['version']) && !is_array($this->queryParts['version'])) {
            $this->queryParts['version'] = [$this->queryParts['version']];
        }
        $this->queryParts['version'][] = $version;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource20GetRequest
     */
    public function withRelease($release) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['release']) && !is_array($this->queryParts['release'])) {
            $this->queryParts['release'] = [$this->queryParts['release']];
        }
        $this->queryParts['release'][] = $release;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource21 extends Resource {

    /**
     * @return Resource22
     */
    public function withLanguage ($language) {
      
        $uri = $this->template($this->getUri() . '/{language}', ['language' => $language]);
        return new Resource22($uri);
    }
}
final class Resource22 extends Resource {

    /**
     * @return Resource23
     */
    public function published() {
        return new Resource23($this->getUri() . '/published');
    }

    /**
     * @return RequestInterface
     */
    public function delete ($body = null, array $options = []) {

        return $this->buildRequest('delete', $this->getUri(), $body, $options);
    }
}
final class Resource23 extends Resource {

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return RequestInterface
     */
    public function delete ($body = null, array $options = []) {

        return $this->buildRequest('delete', $this->getUri(), $body, $options);
    }
}
final class Resource24 extends Resource {

    /**
     * @return Resource25
     */
    public function withToUuid ($toUuid) {
      
        $uri = $this->template($this->getUri() . '/{toUuid}', ['toUuid' => $toUuid]);
        return new Resource25($uri);
    }
}
final class Resource25 extends Resource {

    /**
     * @return Resource25PostRequest
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options, 'Resource25PostRequest');
    }
}
final class Resource25PostRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource25PostRequest
     */
    public function withVersion($version) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['version']) && !is_array($this->queryParts['version'])) {
            $this->queryParts['version'] = [$this->queryParts['version']];
        }
        $this->queryParts['version'][] = $version;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource25PostRequest
     */
    public function withRelease($release) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['release']) && !is_array($this->queryParts['release'])) {
            $this->queryParts['release'] = [$this->queryParts['release']];
        }
        $this->queryParts['release'][] = $release;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource26 extends Resource {

    /**
     * @return Resource26GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource26GetRequest');
    }
}
final class Resource26GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource26GetRequest
     */
    public function withMaxDepth($maxDepth) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['maxDepth']) && !is_array($this->queryParts['maxDepth'])) {
            $this->queryParts['maxDepth'] = [$this->queryParts['maxDepth']];
        }
        $this->queryParts['maxDepth'][] = $maxDepth;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource26GetRequest
     */
    public function withIncludeAll($includeAll) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['includeAll']) && !is_array($this->queryParts['includeAll'])) {
            $this->queryParts['includeAll'] = [$this->queryParts['includeAll']];
        }
        $this->queryParts['includeAll'][] = $includeAll;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource27 extends Resource {

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }

    /**
     * @return Resource27PostRequest
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options, 'Resource27PostRequest');
    }

    /**
     * @return Resource27DeleteRequest
     */
    public function delete ($body = null, array $options = []) {

        return $this->buildRequest('delete', $this->getUri(), $body, $options, 'Resource27DeleteRequest');
    }
}
final class Resource27PostRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource27PostRequest
     */
    public function withRecursive($recursive) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['recursive']) && !is_array($this->queryParts['recursive'])) {
            $this->queryParts['recursive'] = [$this->queryParts['recursive']];
        }
        $this->queryParts['recursive'][] = $recursive;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource27DeleteRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource27DeleteRequest
     */
    public function withRecursive($recursive) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['recursive']) && !is_array($this->queryParts['recursive'])) {
            $this->queryParts['recursive'] = [$this->queryParts['recursive']];
        }
        $this->queryParts['recursive'][] = $recursive;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource28 extends Resource {

    /**
     * @return Resource28GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource28GetRequest');
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return Resource29
     */
    public function withTagUuid ($tagUuid) {
      
        $uri = $this->template($this->getUri() . '/{tagUuid}', ['tagUuid' => $tagUuid]);
        return new Resource29($uri);
    }
}
final class Resource28GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource28GetRequest
     */
    public function withVersion($version) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['version']) && !is_array($this->queryParts['version'])) {
            $this->queryParts['version'] = [$this->queryParts['version']];
        }
        $this->queryParts['version'][] = $version;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource28GetRequest
     */
    public function withRelease($release) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['release']) && !is_array($this->queryParts['release'])) {
            $this->queryParts['release'] = [$this->queryParts['release']];
        }
        $this->queryParts['release'][] = $release;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource29 extends Resource {

    /**
     * @return Resource29PostRequest
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options, 'Resource29PostRequest');
    }

    /**
     * @return RequestInterface
     */
    public function delete ($body = null, array $options = []) {

        return $this->buildRequest('delete', $this->getUri(), $body, $options);
    }
}
final class Resource29PostRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource29PostRequest
     */
    public function withVersion($version) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['version']) && !is_array($this->queryParts['version'])) {
            $this->queryParts['version'] = [$this->queryParts['version']];
        }
        $this->queryParts['version'][] = $version;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource29PostRequest
     */
    public function withRelease($release) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['release']) && !is_array($this->queryParts['release'])) {
            $this->queryParts['release'] = [$this->queryParts['release']];
        }
        $this->queryParts['release'][] = $release;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource30 extends Resource {

    /**
     * @return Resource30GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource30GetRequest');
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return Resource31
     */
    public function withTagFamilyUuid ($tagFamilyUuid) {
      
        $uri = $this->template($this->getUri() . '/{tagFamilyUuid}', ['tagFamilyUuid' => $tagFamilyUuid]);
        return new Resource31($uri);
    }
}
final class Resource30GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource30GetRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource30GetRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource31 extends Resource {

    /**
     * @return Resource32
     */
    public function tags() {
        return new Resource32($this->getUri() . '/tags');
    }

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return RequestInterface
     */
    public function delete ($body = null, array $options = []) {

        return $this->buildRequest('delete', $this->getUri(), $body, $options);
    }
}
final class Resource32 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return Resource32GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource32GetRequest');
    }

    /**
     * @return Resource33
     */
    public function withTagUuid ($tagUuid) {
      
        $uri = $this->template($this->getUri() . '/{tagUuid}', ['tagUuid' => $tagUuid]);
        return new Resource33($uri);
    }
}
final class Resource32GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource32GetRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource32GetRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource33 extends Resource {

    /**
     * @return Resource34
     */
    public function nodes() {
        return new Resource34($this->getUri() . '/nodes');
    }

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return RequestInterface
     */
    public function delete ($body = null, array $options = []) {

        return $this->buildRequest('delete', $this->getUri(), $body, $options);
    }
}
final class Resource34 extends Resource {

    /**
     * @return Resource34GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource34GetRequest');
    }
}
final class Resource34GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource34GetRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource34GetRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource35 extends Resource {

    /**
     * @return Resource36
     */
    public function withPath ($path) {
      
        $uri = $this->template($this->getUri() . '/{path}', ['path' => $path]);
        return new Resource36($uri);
    }
}
final class Resource36 extends Resource {

    /**
     * @return Resource36GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource36GetRequest');
    }
}
final class Resource36GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource36GetRequest
     */
    public function withMaxDepth($maxDepth) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['maxDepth']) && !is_array($this->queryParts['maxDepth'])) {
            $this->queryParts['maxDepth'] = [$this->queryParts['maxDepth']];
        }
        $this->queryParts['maxDepth'][] = $maxDepth;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource36GetRequest
     */
    public function withIncludeAll($includeAll) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['includeAll']) && !is_array($this->queryParts['includeAll'])) {
            $this->queryParts['includeAll'] = [$this->queryParts['includeAll']];
        }
        $this->queryParts['includeAll'][] = $includeAll;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource37 extends Resource {

    /**
     * @return Resource38
     */
    public function withPath ($path) {
      
        $uri = $this->template($this->getUri() . '/{path}', ['path' => $path]);
        return new Resource38($uri);
    }
}
final class Resource38 extends Resource {

    /**
     * @return Resource38GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource38GetRequest');
    }
}
final class Resource38GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource38GetRequest
     */
    public function withFpz($fpz) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['fpz']) && !is_array($this->queryParts['fpz'])) {
            $this->queryParts['fpz'] = [$this->queryParts['fpz']];
        }
        $this->queryParts['fpz'][] = $fpz;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource38GetRequest
     */
    public function withRect($rect) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['rect']) && !is_array($this->queryParts['rect'])) {
            $this->queryParts['rect'] = [$this->queryParts['rect']];
        }
        $this->queryParts['rect'][] = $rect;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource38GetRequest
     */
    public function withW($w) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['w']) && !is_array($this->queryParts['w'])) {
            $this->queryParts['w'] = [$this->queryParts['w']];
        }
        $this->queryParts['w'][] = $w;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource38GetRequest
     */
    public function withH($h) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['h']) && !is_array($this->queryParts['h'])) {
            $this->queryParts['h'] = [$this->queryParts['h']];
        }
        $this->queryParts['h'][] = $h;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource38GetRequest
     */
    public function withFpy($fpy) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['fpy']) && !is_array($this->queryParts['fpy'])) {
            $this->queryParts['fpy'] = [$this->queryParts['fpy']];
        }
        $this->queryParts['fpy'][] = $fpy;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource38GetRequest
     */
    public function withCrop($crop) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['crop']) && !is_array($this->queryParts['crop'])) {
            $this->queryParts['crop'] = [$this->queryParts['crop']];
        }
        $this->queryParts['crop'][] = $crop;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource38GetRequest
     */
    public function withFpx($fpx) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['fpx']) && !is_array($this->queryParts['fpx'])) {
            $this->queryParts['fpx'] = [$this->queryParts['fpx']];
        }
        $this->queryParts['fpx'][] = $fpx;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource39 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return Resource39GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource39GetRequest');
    }

    /**
     * @return Resource40
     */
    public function withReleaseUuid ($releaseUuid) {
      
        $uri = $this->template($this->getUri() . '/{releaseUuid}', ['releaseUuid' => $releaseUuid]);
        return new Resource40($uri);
    }
}
final class Resource39GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource39GetRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource39GetRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource40 extends Resource {

    /**
     * @return Resource41
     */
    public function microschemas() {
        return new Resource41($this->getUri() . '/microschemas');
    }

    /**
     * @return Resource42
     */
    public function migrateMicroschemas() {
        return new Resource42($this->getUri() . '/migrateMicroschemas');
    }

    /**
     * @return Resource43
     */
    public function migrateSchemas() {
        return new Resource43($this->getUri() . '/migrateSchemas');
    }

    /**
     * @return Resource44
     */
    public function schemas() {
        return new Resource44($this->getUri() . '/schemas');
    }

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource41 extends Resource {

    /**
     * @return Resource41GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource41GetRequest');
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource41GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource41GetRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource41GetRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource42 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource43 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource44 extends Resource {

    /**
     * @return Resource44GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource44GetRequest');
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource44GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource44GetRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource44GetRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource45 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource46 extends Resource {

    /**
     * @return Resource47
     */
    public function nodes() {
        return new Resource47($this->getUri() . '/nodes');
    }

    /**
     * @return Resource48
     */
    public function tagFamilies() {
        return new Resource48($this->getUri() . '/tagFamilies');
    }

    /**
     * @return Resource49
     */
    public function tags() {
        return new Resource49($this->getUri() . '/tags');
    }
}
final class Resource47 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource48 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource49 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource50 extends Resource {

    /**
     * @return Resource51
     */
    public function nodes() {
        return new Resource51($this->getUri() . '/nodes');
    }

    /**
     * @return Resource52
     */
    public function tagFamilies() {
        return new Resource52($this->getUri() . '/tagFamilies');
    }

    /**
     * @return Resource53
     */
    public function tags() {
        return new Resource53($this->getUri() . '/tags');
    }
}
final class Resource51 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource52 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource53 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource54 extends Resource {

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }

    /**
     * @return Resource55
     */
    public function withSchemaUuid ($schemaUuid) {
      
        $uri = $this->template($this->getUri() . '/{schemaUuid}', ['schemaUuid' => $schemaUuid]);
        return new Resource55($uri);
    }
}
final class Resource55 extends Resource {

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }

    /**
     * @return RequestInterface
     */
    public function delete ($body = null, array $options = []) {

        return $this->buildRequest('delete', $this->getUri(), $body, $options);
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource56 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return Resource56GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource56GetRequest');
    }

    /**
     * @return Resource57
     */
    public function withUserUuid ($userUuid) {
      
        $uri = $this->template($this->getUri() . '/{userUuid}', ['userUuid' => $userUuid]);
        return new Resource57($uri);
    }
}
final class Resource56GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource56GetRequest
     */
    public function withRole($role) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['role']) && !is_array($this->queryParts['role'])) {
            $this->queryParts['role'] = [$this->queryParts['role']];
        }
        $this->queryParts['role'][] = $role;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource56GetRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource56GetRequest
     */
    public function withResolveLinks($resolveLinks) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['resolveLinks']) && !is_array($this->queryParts['resolveLinks'])) {
            $this->queryParts['resolveLinks'] = [$this->queryParts['resolveLinks']];
        }
        $this->queryParts['resolveLinks'][] = $resolveLinks;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource56GetRequest
     */
    public function withRelease($release) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['release']) && !is_array($this->queryParts['release'])) {
            $this->queryParts['release'] = [$this->queryParts['release']];
        }
        $this->queryParts['release'][] = $release;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource56GetRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource56GetRequest
     */
    public function withLang($lang) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['lang']) && !is_array($this->queryParts['lang'])) {
            $this->queryParts['lang'] = [$this->queryParts['lang']];
        }
        $this->queryParts['lang'][] = $lang;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource56GetRequest
     */
    public function withVersion($version) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['version']) && !is_array($this->queryParts['version'])) {
            $this->queryParts['version'] = [$this->queryParts['version']];
        }
        $this->queryParts['version'][] = $version;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource57 extends Resource {

    /**
     * @return Resource58
     */
    public function resetToken() {
        return new Resource58($this->getUri() . '/reset_token');
    }

    /**
     * @return Resource59
     */
    public function token() {
        return new Resource59($this->getUri() . '/token');
    }

    /**
     * @return Resource60
     */
    public function permissions() {
        return new Resource60($this->getUri() . '/permissions');
    }

    /**
     * @return Resource57PostRequest
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options, 'Resource57PostRequest');
    }

    /**
     * @return RequestInterface
     */
    public function delete ($body = null, array $options = []) {

        return $this->buildRequest('delete', $this->getUri(), $body, $options);
    }

    /**
     * @return Resource57GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource57GetRequest');
    }
}
final class Resource57PostRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource57PostRequest
     */
    public function withToken($token) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['token']) && !is_array($this->queryParts['token'])) {
            $this->queryParts['token'] = [$this->queryParts['token']];
        }
        $this->queryParts['token'][] = $token;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource57GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource57GetRequest
     */
    public function withRole($role) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['role']) && !is_array($this->queryParts['role'])) {
            $this->queryParts['role'] = [$this->queryParts['role']];
        }
        $this->queryParts['role'][] = $role;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource57GetRequest
     */
    public function withLang($lang) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['lang']) && !is_array($this->queryParts['lang'])) {
            $this->queryParts['lang'] = [$this->queryParts['lang']];
        }
        $this->queryParts['lang'][] = $lang;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource57GetRequest
     */
    public function withResolveLinks($resolveLinks) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['resolveLinks']) && !is_array($this->queryParts['resolveLinks'])) {
            $this->queryParts['resolveLinks'] = [$this->queryParts['resolveLinks']];
        }
        $this->queryParts['resolveLinks'][] = $resolveLinks;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource57GetRequest
     */
    public function withVersion($version) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['version']) && !is_array($this->queryParts['version'])) {
            $this->queryParts['version'] = [$this->queryParts['version']];
        }
        $this->queryParts['version'][] = $version;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource57GetRequest
     */
    public function withRelease($release) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['release']) && !is_array($this->queryParts['release'])) {
            $this->queryParts['release'] = [$this->queryParts['release']];
        }
        $this->queryParts['release'][] = $release;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource58 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource59 extends Resource {

    /**
     * @return RequestInterface
     */
    public function delete ($body = null, array $options = []) {

        return $this->buildRequest('delete', $this->getUri(), $body, $options);
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource60 extends Resource {

    /**
     * @return Resource61
     */
    public function withPath ($path) {
      
        $uri = $this->template($this->getUri() . '/{path}', ['path' => $path]);
        return new Resource61($uri);
    }
}
final class Resource61 extends Resource {

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }
}
final class Resource62 extends Resource {

    /**
     * @return Resource62GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource62GetRequest');
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return Resource63
     */
    public function withRoleUuid ($roleUuid) {
      
        $uri = $this->template($this->getUri() . '/{roleUuid}', ['roleUuid' => $roleUuid]);
        return new Resource63($uri);
    }
}
final class Resource62GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource62GetRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource62GetRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource63 extends Resource {

    /**
     * @return Resource64
     */
    public function permissions() {
        return new Resource64($this->getUri() . '/permissions');
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }

    /**
     * @return RequestInterface
     */
    public function delete ($body = null, array $options = []) {

        return $this->buildRequest('delete', $this->getUri(), $body, $options);
    }
}
final class Resource64 extends Resource {

    /**
     * @return Resource65
     */
    public function withPath ($path) {
      
        $uri = $this->template($this->getUri() . '/{path}', ['path' => $path]);
        return new Resource65($uri);
    }
}
final class Resource65 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }
}
final class Resource66 extends Resource {

    /**
     * @return Resource67
     */
    public function linkResolver() {
        return new Resource67($this->getUri() . '/linkResolver');
    }

    /**
     * @return Resource68
     */
    public function validateMicroschema() {
        return new Resource68($this->getUri() . '/validateMicroschema');
    }

    /**
     * @return Resource69
     */
    public function validateSchema() {
        return new Resource69($this->getUri() . '/validateSchema');
    }
}
final class Resource67 extends Resource {

    /**
     * @return Resource67PostRequest
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options, 'Resource67PostRequest');
    }
}
final class Resource67PostRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource67PostRequest
     */
    public function withLang($lang) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['lang']) && !is_array($this->queryParts['lang'])) {
            $this->queryParts['lang'] = [$this->queryParts['lang']];
        }
        $this->queryParts['lang'][] = $lang;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource67PostRequest
     */
    public function withResolveLinks($resolveLinks) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['resolveLinks']) && !is_array($this->queryParts['resolveLinks'])) {
            $this->queryParts['resolveLinks'] = [$this->queryParts['resolveLinks']];
        }
        $this->queryParts['resolveLinks'][] = $resolveLinks;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource68 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource69 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource70 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return Resource70GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource70GetRequest');
    }

    /**
     * @return Resource71
     */
    public function withGroupUuid ($groupUuid) {
      
        $uri = $this->template($this->getUri() . '/{groupUuid}', ['groupUuid' => $groupUuid]);
        return new Resource71($uri);
    }
}
final class Resource70GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource70GetRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource70GetRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource70GetRequest
     */
    public function withRole($role) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['role']) && !is_array($this->queryParts['role'])) {
            $this->queryParts['role'] = [$this->queryParts['role']];
        }
        $this->queryParts['role'][] = $role;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource71 extends Resource {

    /**
     * @return Resource72
     */
    public function roles() {
        return new Resource72($this->getUri() . '/roles');
    }

    /**
     * @return Resource74
     */
    public function users() {
        return new Resource74($this->getUri() . '/users');
    }

    /**
     * @return Resource71GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource71GetRequest');
    }

    /**
     * @return RequestInterface
     */
    public function delete ($body = null, array $options = []) {

        return $this->buildRequest('delete', $this->getUri(), $body, $options);
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource71GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource71GetRequest
     */
    public function withRole($role) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['role']) && !is_array($this->queryParts['role'])) {
            $this->queryParts['role'] = [$this->queryParts['role']];
        }
        $this->queryParts['role'][] = $role;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource72 extends Resource {

    /**
     * @return Resource72GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource72GetRequest');
    }

    /**
     * @return Resource73
     */
    public function withRoleUuid ($roleUuid) {
      
        $uri = $this->template($this->getUri() . '/{roleUuid}', ['roleUuid' => $roleUuid]);
        return new Resource73($uri);
    }
}
final class Resource72GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource72GetRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource72GetRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource72GetRequest
     */
    public function withRole($role) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['role']) && !is_array($this->queryParts['role'])) {
            $this->queryParts['role'] = [$this->queryParts['role']];
        }
        $this->queryParts['role'][] = $role;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource73 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return RequestInterface
     */
    public function delete ($body = null, array $options = []) {

        return $this->buildRequest('delete', $this->getUri(), $body, $options);
    }
}
final class Resource74 extends Resource {

    /**
     * @return Resource74GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource74GetRequest');
    }

    /**
     * @return Resource75
     */
    public function withUserUuid ($userUuid) {
      
        $uri = $this->template($this->getUri() . '/{userUuid}', ['userUuid' => $userUuid]);
        return new Resource75($uri);
    }
}
final class Resource74GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource74GetRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource74GetRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource75 extends Resource {

    /**
     * @return RequestInterface
     */
    public function delete ($body = null, array $options = []) {

        return $this->buildRequest('delete', $this->getUri(), $body, $options);
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource76 extends Resource {

    /**
     * @return Resource77
     */
    public function login() {
        return new Resource77($this->getUri() . '/login');
    }

    /**
     * @return Resource78
     */
    public function logout() {
        return new Resource78($this->getUri() . '/logout');
    }

    /**
     * @return Resource79
     */
    public function me() {
        return new Resource79($this->getUri() . '/me');
    }
}
final class Resource77 extends Resource {

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource78 extends Resource {

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }
}
final class Resource79 extends Resource {

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }
}
final class Resource80 extends Resource {

    /**
     * @return Resource80GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource80GetRequest');
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return Resource81
     */
    public function withProjectUuid ($projectUuid) {
      
        $uri = $this->template($this->getUri() . '/{projectUuid}', ['projectUuid' => $projectUuid]);
        return new Resource81($uri);
    }
}
final class Resource80GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource80GetRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource80GetRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource80GetRequest
     */
    public function withRole($role) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['role']) && !is_array($this->queryParts['role'])) {
            $this->queryParts['role'] = [$this->queryParts['role']];
        }
        $this->queryParts['role'][] = $role;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource81 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return RequestInterface
     */
    public function delete ($body = null, array $options = []) {

        return $this->buildRequest('delete', $this->getUri(), $body, $options);
    }

    /**
     * @return Resource81GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource81GetRequest');
    }
}
final class Resource81GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource81GetRequest
     */
    public function withRole($role) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['role']) && !is_array($this->queryParts['role'])) {
            $this->queryParts['role'] = [$this->queryParts['role']];
        }
        $this->queryParts['role'][] = $role;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource82 extends Resource {

    /**
     * @return Resource82GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource82GetRequest');
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return Resource83
     */
    public function withSchemaUuid ($schemaUuid) {
      
        $uri = $this->template($this->getUri() . '/{schemaUuid}', ['schemaUuid' => $schemaUuid]);
        return new Resource83($uri);
    }
}
final class Resource82GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource82GetRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource82GetRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource83 extends Resource {

    /**
     * @return Resource84
     */
    public function diff() {
        return new Resource84($this->getUri() . '/diff');
    }

    /**
     * @return Resource85
     */
    public function changes() {
        return new Resource85($this->getUri() . '/changes');
    }

    /**
     * @return Resource83GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource83GetRequest');
    }

    /**
     * @return RequestInterface
     */
    public function delete ($body = null, array $options = []) {

        return $this->buildRequest('delete', $this->getUri(), $body, $options);
    }

    /**
     * @return Resource83PostRequest
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options, 'Resource83PostRequest');
    }
}
final class Resource83GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource83GetRequest
     */
    public function withVersion($version) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['version']) && !is_array($this->queryParts['version'])) {
            $this->queryParts['version'] = [$this->queryParts['version']];
        }
        $this->queryParts['version'][] = $version;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource83GetRequest
     */
    public function withRelease($release) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['release']) && !is_array($this->queryParts['release'])) {
            $this->queryParts['release'] = [$this->queryParts['release']];
        }
        $this->queryParts['release'][] = $release;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource83PostRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource83PostRequest
     */
    public function withUpdateReleaseNames($updateReleaseNames) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['updateReleaseNames']) && !is_array($this->queryParts['updateReleaseNames'])) {
            $this->queryParts['updateReleaseNames'] = [$this->queryParts['updateReleaseNames']];
        }
        $this->queryParts['updateReleaseNames'][] = $updateReleaseNames;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource83PostRequest
     */
    public function withUpdateAssignedReleases($updateAssignedReleases) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['updateAssignedReleases']) && !is_array($this->queryParts['updateAssignedReleases'])) {
            $this->queryParts['updateAssignedReleases'] = [$this->queryParts['updateAssignedReleases']];
        }
        $this->queryParts['updateAssignedReleases'][] = $updateAssignedReleases;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource84 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource85 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource86 extends Resource {

    /**
     * @return Resource86GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource86GetRequest');
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return Resource87
     */
    public function withMicroschemaUuid ($microschemaUuid) {
      
        $uri = $this->template($this->getUri() . '/{microschemaUuid}', ['microschemaUuid' => $microschemaUuid]);
        return new Resource87($uri);
    }
}
final class Resource86GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource86GetRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource86GetRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource87 extends Resource {

    /**
     * @return Resource88
     */
    public function changes() {
        return new Resource88($this->getUri() . '/changes');
    }

    /**
     * @return Resource89
     */
    public function diff() {
        return new Resource89($this->getUri() . '/diff');
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return RequestInterface
     */
    public function delete ($body = null, array $options = []) {

        return $this->buildRequest('delete', $this->getUri(), $body, $options);
    }

    /**
     * @return Resource87GetRequest
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options, 'Resource87GetRequest');
    }
}
final class Resource87GetRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource87GetRequest
     */
    public function withVersion($version) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['version']) && !is_array($this->queryParts['version'])) {
            $this->queryParts['version'] = [$this->queryParts['version']];
        }
        $this->queryParts['version'][] = $version;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource87GetRequest
     */
    public function withRelease($release) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['release']) && !is_array($this->queryParts['release'])) {
            $this->queryParts['release'] = [$this->queryParts['release']];
        }
        $this->queryParts['release'][] = $release;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource88 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource89 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource90 extends Resource {

    /**
     * @return Resource91
     */
    public function cluster() {
        return new Resource91($this->getUri() . '/cluster');
    }

    /**
     * @return Resource93
     */
    public function consistency() {
        return new Resource93($this->getUri() . '/consistency');
    }

    /**
     * @return Resource96
     */
    public function graphdb() {
        return new Resource96($this->getUri() . '/graphdb');
    }

    /**
     * @return Resource99
     */
    public function jobs() {
        return new Resource99($this->getUri() . '/jobs');
    }

    /**
     * @return Resource102
     */
    public function plugins() {
        return new Resource102($this->getUri() . '/plugins');
    }

    /**
     * @return Resource104
     */
    public function status() {
        return new Resource104($this->getUri() . '/status');
    }

    /**
     * @return Resource105
     */
    public function processJobs() {
        return new Resource105($this->getUri() . '/processJobs');
    }
}
final class Resource91 extends Resource {

    /**
     * @return Resource92
     */
    public function status() {
        return new Resource92($this->getUri() . '/status');
    }
}
final class Resource92 extends Resource {

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }
}
final class Resource93 extends Resource {

    /**
     * @return Resource94
     */
    public function repair() {
        return new Resource94($this->getUri() . '/repair');
    }

    /**
     * @return Resource95
     */
    public function check() {
        return new Resource95($this->getUri() . '/check');
    }
}
final class Resource94 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource95 extends Resource {

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }
}
final class Resource96 extends Resource {

    /**
     * @return Resource97
     */
    public function restore() {
        return new Resource97($this->getUri() . '/restore');
    }

    /**
     * @return Resource98
     */
    public function backup() {
        return new Resource98($this->getUri() . '/backup');
    }
}
final class Resource97 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource98 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource99 extends Resource {

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }

    /**
     * @return Resource100
     */
    public function withJobUuid ($jobUuid) {
      
        $uri = $this->template($this->getUri() . '/{jobUuid}', ['jobUuid' => $jobUuid]);
        return new Resource100($uri);
    }
}
final class Resource100 extends Resource {

    /**
     * @return Resource101
     */
    public function error() {
        return new Resource101($this->getUri() . '/error');
    }

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }

    /**
     * @return RequestInterface
     */
    public function delete ($body = null, array $options = []) {

        return $this->buildRequest('delete', $this->getUri(), $body, $options);
    }
}
final class Resource101 extends Resource {

    /**
     * @return RequestInterface
     */
    public function delete ($body = null, array $options = []) {

        return $this->buildRequest('delete', $this->getUri(), $body, $options);
    }
}
final class Resource102 extends Resource {

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }

    /**
     * @return Resource103
     */
    public function withUuid ($uuid) {
      
        $uri = $this->template($this->getUri() . '/{uuid}', ['uuid' => $uuid]);
        return new Resource103($uri);
    }
}
final class Resource103 extends Resource {

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }

    /**
     * @return RequestInterface
     */
    public function delete ($body = null, array $options = []) {

        return $this->buildRequest('delete', $this->getUri(), $body, $options);
    }
}
final class Resource104 extends Resource {

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }
}
final class Resource105 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource106 extends Resource {

    /**
     * @return Resource107
     */
    public function groups() {
        return new Resource107($this->getUri() . '/groups');
    }

    /**
     * @return Resource108
     */
    public function nodes() {
        return new Resource108($this->getUri() . '/nodes');
    }

    /**
     * @return Resource109
     */
    public function roles() {
        return new Resource109($this->getUri() . '/roles');
    }

    /**
     * @return Resource110
     */
    public function status() {
        return new Resource110($this->getUri() . '/status');
    }

    /**
     * @return Resource111
     */
    public function tagFamilies() {
        return new Resource111($this->getUri() . '/tagFamilies');
    }

    /**
     * @return Resource112
     */
    public function users() {
        return new Resource112($this->getUri() . '/users');
    }

    /**
     * @return Resource113
     */
    public function microschemas() {
        return new Resource113($this->getUri() . '/microschemas');
    }

    /**
     * @return Resource114
     */
    public function schemas() {
        return new Resource114($this->getUri() . '/schemas');
    }

    /**
     * @return Resource115
     */
    public function tags() {
        return new Resource115($this->getUri() . '/tags');
    }

    /**
     * @return Resource116
     */
    public function projects() {
        return new Resource116($this->getUri() . '/projects');
    }

    /**
     * @return Resource117
     */
    public function clear() {
        return new Resource117($this->getUri() . '/clear');
    }

    /**
     * @return Resource118
     */
    public function sync() {
        return new Resource118($this->getUri() . '/sync');
    }
}
final class Resource107 extends Resource {

    /**
     * @return Resource107PostRequest
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options, 'Resource107PostRequest');
    }
}
final class Resource107PostRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource107PostRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource107PostRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource108 extends Resource {

    /**
     * @return Resource108PostRequest
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options, 'Resource108PostRequest');
    }
}
final class Resource108PostRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource108PostRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource108PostRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource109 extends Resource {

    /**
     * @return Resource109PostRequest
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options, 'Resource109PostRequest');
    }
}
final class Resource109PostRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource109PostRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource109PostRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource110 extends Resource {

    /**
     * @return RequestInterface
     */
    public function get ($query = null, array $options = []) {


        if (!is_array($query)) {
            $query = Psr7\parse_query($query);
        }
        if (isset($options['query'])) {        
            $query = array_merge($options['query'], $query);
        }
        $options['query'] = $query;
        return $this->buildRequest('get', $this->getUri(), null, $options);
    }
}
final class Resource111 extends Resource {

    /**
     * @return Resource111PostRequest
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options, 'Resource111PostRequest');
    }
}
final class Resource111PostRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource111PostRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource111PostRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource112 extends Resource {

    /**
     * @return Resource112PostRequest
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options, 'Resource112PostRequest');
    }
}
final class Resource112PostRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource112PostRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource112PostRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource113 extends Resource {

    /**
     * @return Resource113PostRequest
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options, 'Resource113PostRequest');
    }
}
final class Resource113PostRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource113PostRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource113PostRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource114 extends Resource {

    /**
     * @return Resource114PostRequest
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options, 'Resource114PostRequest');
    }
}
final class Resource114PostRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource114PostRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource114PostRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource115 extends Resource {

    /**
     * @return Resource115PostRequest
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options, 'Resource115PostRequest');
    }
}
final class Resource115PostRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource115PostRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource115PostRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource116 extends Resource {

    /**
     * @return Resource116PostRequest
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options, 'Resource116PostRequest');
    }
}
final class Resource116PostRequest extends Request {

    private $query;
    private $queryParts;

    /**
     * @return Resource116PostRequest
     */
    public function withPerPage($perPage) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['perPage']) && !is_array($this->queryParts['perPage'])) {
            $this->queryParts['perPage'] = [$this->queryParts['perPage']];
        }
        $this->queryParts['perPage'][] = $perPage;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                

    /**
     * @return Resource116PostRequest
     */
    public function withPage($page) {
        $query = $this->getUri()->getQuery();
        if ($this->query !== $query) {
            $this->queryParts = Psr7\parse_query($query);
        }
        if (isset($this->queryParts['page']) && !is_array($this->queryParts['page'])) {
            $this->queryParts['page'] = [$this->queryParts['page']];
        }
        $this->queryParts['page'][] = $page;
        ksort($this->queryParts);
        $this->query = Psr7\build_query($this->queryParts);
        return $this->withUri($this->getUri()->withQuery($this->query));
    }
                
}
final class Resource117 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
final class Resource118 extends Resource {

    /**
     * @return RequestInterface
     */
    public function post ($body = null, array $options = []) {

        return $this->buildRequest('post', $this->getUri(), $body, $options);
    }
}
