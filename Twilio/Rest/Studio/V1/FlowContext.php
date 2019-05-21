<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Studio\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\Rest\Studio\V1\Flow\EngagementList;
use Twilio\Rest\Studio\V1\Flow\ExecutionList;
use Twilio\Values;
use Twilio\Version;

/**
 * @property \Twilio\Rest\Studio\V1\Flow\EngagementList engagements
 * @property \Twilio\Rest\Studio\V1\Flow\ExecutionList executions
 * @method \Twilio\Rest\Studio\V1\Flow\EngagementContext engagements(string $sid)
 * @method \Twilio\Rest\Studio\V1\Flow\ExecutionContext executions(string $sid)
 */
class FlowContext extends InstanceContext {
    protected $_engagements = null;
    protected $_executions = null;

    /**
     * Initialize the FlowContext
     *
     * @param \Twilio\Version $version Version that contains the resource
     * @param string $sid A string that uniquely identifies this Flow.
     * @return \Twilio\Rest\Studio\V1\FlowContext
     */
    public function __construct(Version $version, $sid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = array('sid' => $sid, );

        $this->uri = '/Flows/' . rawurlencode($sid) . '';
    }

    /**
     * Fetch a FlowInstance
     *
     * @return FlowInstance Fetched FlowInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() {
        $params = Values::of(array());

        $payload = $this->version->fetch(
            'GET',
            $this->uri,
            $params
        );

        return new FlowInstance($this->version, $payload, $this->solution['sid']);
    }

    /**
     * Deletes the FlowInstance
     *
     * @return boolean True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() {
        return $this->version->delete('delete', $this->uri);
    }

    /**
     * Access the engagements
     *
     * @return \Twilio\Rest\Studio\V1\Flow\EngagementList
     */
    protected function getEngagements() {
        if (!$this->_engagements) {
            $this->_engagements = new EngagementList($this->version, $this->solution['sid']);
        }

        return $this->_engagements;
    }

    /**
     * Access the executions
     *
     * @return \Twilio\Rest\Studio\V1\Flow\ExecutionList
     */
    protected function getExecutions() {
        if (!$this->_executions) {
            $this->_executions = new ExecutionList($this->version, $this->solution['sid']);
        }

        return $this->_executions;
    }

    /**
     * Magic getter to lazy load subresources
     *
     * @param string $name Subresource to return
     * @return \Twilio\ListResource The requested subresource
     * @throws \Twilio\Exceptions\TwilioException For unknown subresources
     */
    public function __get($name) {
        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown subresource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return \Twilio\InstanceContext The requested resource context
     * @throws \Twilio\Exceptions\TwilioException For unknown resource
     */
    public function __call($name, $arguments) {
        $property = $this->$name;
        if (method_exists($property, 'getContext')) {
            return call_user_func_array(array($property, 'getContext'), $arguments);
        }

        throw new TwilioException('Resource does not have a context');
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
        return '[Twilio.Studio.V1.FlowContext ' . implode(' ', $context) . ']';
    }
}