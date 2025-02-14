<?php

namespace BNSoftware\Lti1p3;

class LtiCourseGroupsService extends LtiAbstractService
{
    public const CONTENT_TYPE_CONTEXT_GROUP_CONTAINER = 'application/vnd.ims.lti-gs.v1.contextgroupcontainer+json';

    /**
     * @return array
     */
    public function getScope(): array
    {
        return $this->getServiceData()['scope'];
    }

    /**
     * @return array
     */
    public function getGroups(): array
    {
        $request = new ServiceRequest(
            ServiceRequest::METHOD_GET,
            $this->getServiceData()['context_groups_url'],
            ServiceRequest::TYPE_GET_GROUPS
        );
        $request->setAccept(static::CONTENT_TYPE_CONTEXT_GROUP_CONTAINER);

        return $this->getAll($request, 'groups');
    }

    /**
     * @return array
     */
    public function getSets(): array
    {
        // Sets are optional.
        if (!isset($this->getServiceData()['context_group_sets_url'])) {
            return [];
        }

        $request = new ServiceRequest(
            ServiceRequest::METHOD_GET,
            $this->getServiceData()['context_group_sets_url'],
            ServiceRequest::TYPE_GET_SETS
        );
        $request->setAccept(static::CONTENT_TYPE_CONTEXT_GROUP_CONTAINER);

        return $this->getAll($request, 'sets');
    }

    /**
     * @return array
     */
    public function getGroupsBySet(): array
    {
        $groups = $this->getGroups();
        $sets = $this->getSets();

        $groupsBySet = [];
        $unsetted = [];

        foreach ($sets as $key => $set) {
            $groupsBySet[$set['id']] = $set;
            $groupsBySet[$set['id']]['groups'] = [];
        }

        foreach ($groups as $key => $group) {
            if (isset($group['set_id']) && isset($groupsBySet[$group['set_id']])) {
                $groupsBySet[$group['set_id']]['groups'][$group['id']] = $group;
            } else {
                $unsetted[$group['id']] = $group;
            }
        }

        if (!empty($unsetted)) {
            $groupsBySet['none'] = [
                'name' => 'None',
                'id' => 'none',
                'groups' => $unsetted,
            ];
        }

        return $groupsBySet;
    }
}
