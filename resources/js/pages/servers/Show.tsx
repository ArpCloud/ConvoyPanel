import { DefaultProps } from '@/api/types/default'
import { Server } from '@/api/types/server'
import Authenticated from '@/components/layouts/Authenticated'
import Main from '@/components/Main'
import { Head } from '@inertiajs/inertia-react'

interface Props extends DefaultProps {
    server: Server
}

const Show = ({ auth, server}: Props) => {

    return <Authenticated
      auth={auth}
      header={
        <h1 className='h1'>
          { server.name }
        </h1>
      }
    >
      <Head title={`${server.name} — Overview`} />

      <Main>
      </Main>
    </Authenticated>
}

export default Show