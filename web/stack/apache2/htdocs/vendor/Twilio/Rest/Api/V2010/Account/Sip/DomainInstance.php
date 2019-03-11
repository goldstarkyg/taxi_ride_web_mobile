<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\Sip;

use Twilio\Deserialize;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Version;

/**
 * @property string accountSid
 * @property string apiVersion
 * @property string authType
 * @property \DateTime dateCreated
 * @property \DateTime dateUpdated
 * @property string domainName
 * @property string friendlyName
 * @property string sid
 * @property string uri
 * @property string voiceFallbackMethod
 * @property string voiceFallbackUrl
 * @property string voiceMethod
 * @property string voiceStatusCallbackMethod
 * @property string voiceStatusCallbackUrl
 * @property string voiceUrl
 */
class DomainInstance extends InstanceResource {
    protected $_ipAccessControlListMappings = null;
    protected $_credentialListMappings = null;

    /**
     * Initialize the DomainInstance
     * 
     * @param \Twilio\Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $accountSid A 34 character string that uniquely identifies
     *                           this resource.
     * @param string $sid Fetch by unique Domain Sid
     * @return \Twilio\Rest\Api\V2010\Account\Sip\DomainInstance 
     */
    public function __construct(Version $version, array $payload, $accountSid, $sid = null) {
        parent::__construct($version);
        
        // Marshaled Properties
        $this->properties = array(
            'accountSid' => $payload['account_sid'],
            'apiVersion' => $payload['api_version'],
            'authType' => $payload['auth_type'],
            'dateCreated' => Deserialize::iso8601DateTime($payload['date_created']),
            'dateUpdated' => Deserialize::iso8601DateTime($payload['date_updated']),
            'domainName' => $payload['domain_name'],
            'friendlyName' => $payload['friendly_name'],
            'sid' => $payload['sid'],
            'uri' => $payload['uri'],
            'voiceFallbackMethod' => $payload['voice_fallback_method'],
            'voiceFallbackUrl' => $payload['voice_fallback_url'],
            'voiceMethod' => $payload['voice_method'],
            'voiceStatusCallbackMethod' => $payload['voice_status_callback_method'],
            'voiceStatusCallbackUrl' => $payload['voice_status_callback_url'],
            'voiceUrl' => $payload['voice_url'],
        );
        
        $this->solution = array(
            'accountSid' => $accountSid,
            'sid' => $sid ?: $this->properties['sid'],
        );
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     * 
     * @return \Twilio\Rest\Api\V2010\Account\Sip\DomainContext Context for this
     *                                                          DomainInstance
     */
    protected function proxy() {
        if (!$this->context) {
            $this->context = new DomainContext(
                $this->version,
                $this->solution['accountSid'],
                $this->solution['sid']
            );
        }
        
        return $this->context;
    }

    /**
     * Fetch a DomainInstance
     * 
     * @return DomainInstance Fetched DomainInstance
     */
    public function fetch() {
        return $this->proxy()->fetch();
    }

    /**
     * Update the DomainInstance
     * 
     * @param array|Options $options Optional Arguments
     * @return DomainInstance Updated DomainInstance
     */
    public function update($options = array()) {
        return $this->proxy()->update(
            $options
        );
    }

    /**
     * Deletes the DomainInstance
     * 
     * @return boolean True if delete succeeds, false otherwise
     */
    public function delete() {
        return $this->proxy()->delete();
    }

    /**
     * Access the ipAccessControlListMappings
     * 
     * @return \Twilio\Rest\Api\V2010\Account\Sip\Domain\IpAccessControlListMappingList 
     */
    protected function getIpAccessControlListMappings() {
        return $this->proxy()->ipAccessControlListMappings;
    }

    /**
     * Access the credentialListMappings
     * 
     * @return \Twilio\Rest\Api\V2010\Account\Sip\Domain\CredentialListMappingList 
     */
    protected function getCredentialListMappings() {
        return $this->proxy()->credentialListMappings;
    }

    /**
     * Magic getter to access properties
     * 
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get($name) {
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }
        
        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }
        
        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $context = array();
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Api.V2010.DomainInstance ' . implode(' ', $context) . ']';
    }
}