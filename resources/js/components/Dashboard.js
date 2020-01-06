import React, {useCallback, useState} from 'react';
import {Card, Tabs} from '@shopify/polaris';
import Total from './Total';
import ListData from './ListData';

export default function Dashboard() {
  const [selected, setSelected] = useState(0);

  const handleTabChange = useCallback(
    (selectedTabIndex) => setSelected(selectedTabIndex),
    [],
  );

  const tabs = [
    {
      id: 'all-customers',
      content: 'Total',
      component: <Total></Total>,
      accessibilityLabel: 'All customers',
      panelID: 'all-customers-content',
    },
    {
      id: 'accepts-marketing',
      content: 'List data',
      component: <ListData></ListData>,
      panelID: 'accepts-marketing-content',
    },
    {
      id: 'repeat-customers',
      content: 'Repeat customers',
      component: 'Repeat customers',
      panelID: 'repeat-customers-content',
    },
    {
      id: 'prospects',
      content: 'Prospects',
      component: 'Prospects',
      panelID: 'prospects-content',
    },
  ];
  return (
      <Tabs tabs={tabs} selected={selected} onSelect={handleTabChange}>
          {tabs[selected].component}
      </Tabs>
  );
}
